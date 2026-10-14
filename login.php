<?php
session_start();
if (isset($_POST['submitted'])){ #checks if form has been submitted
  require_once('connectdb.php'); #database connecction file is loaded

#variables created and data is stored in them, otherwise it stores false.
$username = isset($_POST['username'])?$_POST['username']:FALSE;
$password = isset($_POST['password'])?$_POST['password']:FALSE;

#if the username and password are left empty or don't match what is stored, login fails.
if (!($username)){
    echo "Incorrect Username";
    exit;
}
if (!($password)){
    exit("Incorrect Password");
}

#sql query which looks for cv_id in database and makes sure it matches entered username
$stat=$db->prepare("SELECT * FROM cvs WHERE cv_id = ?");
$stat->execute(array($username));
$user = $stat -> fetch(); #gets the result from database

if ($user && password_verify($password, $user['password'])) { #checks if user exists and compared password to stored one. 
    $_SESSION['user_id'] = $user['cv_id']; #the user id is stored in a session
    $_SESSION['username'] = $user['cv_id'];
    header("Location: mycv.php"); #after login redirects to cv page.
    exit();
}
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Aston CV Login </title>
<style>
body{
    text-align: center;
    font-family: Arial; 
    background-color: rgba(241, 217, 253, 0.6);
}
input[type="text"] {
    width: 200px;
    padding: 0px;
    font-size: 16px;
}
h2, p {
  margin: 30px;
}
</style>
</head>
<body>
<!--user input of login details-->
  <h2>Login</h2>
  <form method = "post" action="login.php">
	Username: <input type="text" name="username" /><br>
	Password: <input type="password" name="password" /><br><br>

	<input type="submit" value="Login" />  
	<input type="hidden" name="submitted" value="true"/> 
  <a href="register.php">Don't have an account yet?</a> <!--directs user to register page-->
  </form> 
</body>
</html>