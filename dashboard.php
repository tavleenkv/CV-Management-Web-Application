<?php
require_once('connectdb.php'); #database connecction file is loaded
$search = "";
if (isset($_GET['search'])){
    $search = $_GET['search'];
}
$stat=$db->prepare("SELECT * FROM cvs WHERE name LIKE ? OR programming_language LIKE ?");  #allows search to only be based on name or programming language in database
$stat->execute(array("%$search%", "%$search%"));  #search is carried out
?>
<!DOCTYPE html>
<html>
<head>
  <title>CV Dashboard</title>
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
ul li a:hover:not(.active) {  /*allows user to hover over links to different pages*/
  background-color: #59535a;
}
ul li a.active { /*allows user to know which page they are currently on*/
  background-color: #b623be;
}
  </style>
</head>
<body>
 <ul> <!--navigation bar-->
    <li><a href="mycv.php">MY CV</a></li> 
    <li><a href="index.php">Search</a></li>     
    <li><a class="active" href="dashboard.php">All CVs</a></li>
    <li><a href="logout.php">Logout</a></li>
</ul>
<h2>Results</h2>
<?php
while ($row = $stat->fetch()){   #gets these details and presents them to user in seperate rows
    echo "Name: " . $row['name'] . "<br>";
    echo "Email: " . $row['email'] . "<br>";
    echo "Programming Language : " . $row['programming_language'] . "<br>";    
    echo "<a href='cv.php?id=" . $row['cv_id'] . "'>View full CV</a>" . "<br>" . "<br>";
}
?>
  <a href="index.php">Back to Search</a> <br>
</body> 
</html>
