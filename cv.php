<?php
require_once('connectdb.php'); #database connecction file is loaded

if (!isset($_GET['id'])) { #checks if the ID exists.
    echo "No CV selected";
    exit();
}
$id = $_GET['id'];
try {
    $stat=$db->prepare("SELECT * FROM cvs WHERE cv_id = ?");
    $stat->execute(array($id));
    $user = $stat -> fetch(); #gets the result from database

    if (!$user){ #if the user doesnt exist based on entered id, error message shown and exits the page
        echo "CV not found";
        exit();
    }
} catch (PDOexception $ex) {
    echo "Error: " . $ex->getMessage();
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
    <li><a href="mycv.php">My CV</a></li> 
    <li><a class="active" href="cv.php">CVs</a></li> 
    <li><a href="index.php">Search</a></li> 
    <li><a href="dashboard.php">All CVs</a></li> 
    <li><a href="logout.php">Logout</a></li>
</ul>   
  <h2>CV</h2>   <!--presents all of the follwoing data for the user-->
  <p><b>Name:</b> <?php echo $user['name']; ?></p>
  <p><b>Email:</b> <?php echo $user['email']; ?></p>
  <p><b>Education:</b> <?php echo $user['education']; ?></p>
  <p><b>Programming_Language:</b> <?php echo $user['programming_language']; ?></p>
  <p><b>Profile:</b> <?php echo $user['profile']; ?></p>
  <p><b>Links:</b> <?php echo $user['links']; ?></p>
  <a href="dashboard.php">Back to list</a>
</body>
</html>