<!DOCTYPE html>
<html>
<head>
  <title>Aston CV</title>
  <style> 
  body {
    margin: 0;
    padding: 0; 
    text-align: center;
    font-family: Arial; 
    background-color: rgba(241, 217, 253, 0.6);
}
input[type="text"] {
    width: 400px;
    padding: 10px;
    font-size: 20px;
    text-align: center;
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

ul li a.active {  /*allows user to know which page they are currently on*/
  background-color: #b623be;
}
</style>
</head>
<body>
<ul>
    <!--navigation bar-->
    <li><a href="mycv.php">MY CV</a></li> 
    <li><a class="active" href="index.php">Search</a></li> 
    <li><a href="dashboard.php">All CVs</a></li> 
    <li><a href="logout.php">Logout</a></li>
</ul>   
  </style>
</head>
<body>
  <h2>Search</h2>
  <form method = "get" action="dashboard.php"> <!--retrieves data based on user query from dashboard which stores all cv data-->
    <input type="text" name="search" placeholder = "Search by name or Programming Language">
    <br><br>
	<input type="submit" value="Search">  
</form> 
</body>
</html>