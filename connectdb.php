<?php

$db_host = 'localhost';
$db_name = 'dg250202940_astoncv';
$username = 'dg250202940';
$password = 'diUvrktaeNiowhothkKTfO7QH';

try {
	$db = new PDO("mysql:dbname=$db_name;host=$db_host", $username, $password); 
} catch(PDOException $ex) {
	echo("Failed to connect to the database.<br>");
	echo($ex->getMessage());
	exit;
}
?>