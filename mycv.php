<?php
session_start();
require_once('connectdb.php'); #database connecction file is loaded

if (!isset($_SESSION['user_id'])) { #checks if the user is logged in
    header("Location: login.php");
    exit();
}
$id = $_SESSION['user_id'];

if(isset($_POST['save'])){
    #gets the data from the form
    $name=$_POST['name'];
    $email=$_POST['email'];
    $education=$_POST['education'];
    $programming_language=$_POST['programming_language'];
    $profile=$_POST['profile'];
    $links=$_POST['links']; 


#llows user to change all any of their details and their current record on the database is updated.
    $stat=$db->prepare("UPDATE cvs SET name=?, email=?, education=?, programming_language=?, profile=?, links=? WHERE cv_id=?");
    $stat->execute(array($name, $email, $education, $programming_language, $profile, $links, $id));
    echo "CV Updated";
}
$stat=$db->prepare("SELECT * FROM cvs WHERE cv_id = ?");
$stat->execute(array($id));
$user = $stat -> fetch(); #gets the result from database based on the id

$editing = false;
if (isset($_GET['edit'])){
    $editing = true;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Aston CV</title>
  <style>
body{
    margin: 0;
    padding: 0; 
    text-align: center;
    font-family: Arial; 
    background-color: rgba(241, 217, 253, 0.6);
}
input[type="text"] {
    width: 200px;
    height: 0px;
    padding: 10px;
    font-size: 15px;
    text-align: left;
}
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  background-color: rgb(216, 132, 216);
  display: flex;
}
ul li a {
  display: block;
  color: white;
  padding: 14px 16px;
  text-decoration: none;
}
ul li a:hover:not(.active) { /*allows user to hover over links to different pages*/
  background-color: #59535a;
}
ul li a.active { /*allows user to know which page they are currently on*/
  background-color: #b623be;
}
</style>
</head>
<body>
<ul> <!--navigation bar-->
    <li><a class="active" href="mycv.php">My CV</a></li> 
    <li><a href="index.php">Search</a></li> 
    <li><a href="dashboard.php">All CVs</a></li> 
    <li><a href="logout.php">Logout</a></li>
</ul>   
<body>
<h2>My CV</h2>
<?php 
if($editing == true) {  #if the user chooses to edit, they are given empty textboxes to enter in
?>
<form method = "post">
    Name: <input type="text" name="name" value="<?php echo $user['name'];?>"/><br>
    Email: <input type="email" name="email" value="<?php echo $user['email'];?>"/><br>
    Education: <input type="text" name="education" value="<?php echo $user['education'];?>"/><br>
    Programming_Language: <input type="text" name="programming_language" value="<?php echo $user['programming_language'];?>"/><br>
    Profile: <input type="text" name="profile" value="<?php echo $user['profile'];?>"/><br>
    Links: <input type="text" name="links" value="<?php echo $user['links'];?>"/><br>

    <input type="submit" name="save" value="Save">  
</form>
<a href="mycv.php">Back</a>

<?php
} else {
?>
<p><b>Name:</b> <?php echo $user['name'];?></p>
<p><b>Email:</b> <?php echo $user['email'];?></p>
<p><b>Education:</b> <?php echo $user['education'];?></p>
<p><b>Programming_Language:</b> <?php echo $user['programming_language'];?></p>
<p><b>Profile:</b> <?php echo $user['profile'];?></p>
<p><b>Links:</b> <?php echo $user['links'];?></p>
<a href="mycv.php?edit=1">Edit CV</a>
<?php
}
?>
</body>
</html>
