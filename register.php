<?php
session_start();

if (isset($_POST['submitted'])){ #checks if form has been submitted
  require_once('connectdb.php'); #database connecction file is loaded

#variables created and data is stored in them, otherwise it stores false.
  $name=isset($_POST['name'])?$_POST['name']:false; 
  $email=isset($_POST['email'])?$_POST['email']:false;
  $password=isset($_POST['password'])?$_POST['password']:false; #turned into a secure hashed password
  $education=isset($_POST['education'])?$_POST['education']:false;
  $programming_language=isset($_POST['programming_language'])?$_POST['programming_language']:false;
  $profile=isset($_POST['profile'])?$_POST['profile']:false;
  $links=isset($_POST['links'])?$_POST['links']:false;

  #validation
  if (empty($name)) {
    echo "Name is required";
    exit();
  }
    if (empty($email)) {
    echo "Email is required";
    exit();
  }
    if (empty($password)) {
    echo "Password is required";
    exit();
  }
  $password = password_hash($password, PASSWORD_DEFAULT); #turned into a secure hashed password
  
 try{    
	$stat=$db->prepare("INSERT into cvs (name, email, password, education, programming_language, profile, links) VALUES (?, ?, ?, ?, ?, ?, ?)"); #inserts values entered into the database
	$stat->execute(array($name, $email, $password, $education, $programming_language, $profile, $links));
	
	$id=$db->LastInsertId(); #provides users with the id of their data entry to use as their username
    $_SESSION['user_id'] = $id;
    $_SESSION['username'] = $id;
	echo "You are now registered. Your Username is: $id";  	
	
 }
 catch (PDOexception $ex){
	echo "Sorry, a database error occurred! <br>";
	echo "Error details: <em>". $ex->getMessage()."</em>";
 }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Aston CV </title>
<style>
body{
  text-align: center;
  background-color: rgba(241, 217, 253, 0.6);
}
input[type="text"] {
  width: 200px;
  padding: 0px;
  font-size: 16px;
  font-family: Arial; 
}
</style>
</head>
<body>
<!--allows user input of the following categories-->
  <h2>Register</h2>
  <form method = "post" action="register.php">
    Name: <input type="text" name="name" /><br>
    Email: <input type="email" name="email" /><br>
    Password: <input type="password" name="password" /><br>
    Education: <input type="text" name="education" /><br>
    Programming_Language: <input type="text" name="programming_language" /><br>
    Profile: <input type="text" name="profile" /><br>
    Links: <input type="text" name="links" /><br>

<!--form buttons-->
	<input type="submit" value="Register" />  
	<input type="reset" value="clear"/> 
	<input type="hidden" name="submitted" value="true"/> 
  </form>  
  <p> Already have an account? <a href = "login.php">Log in</a>  </p> <!--directs user to login page-->
</body>
</html>
