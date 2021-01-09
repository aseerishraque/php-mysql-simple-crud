<?php

$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'simple_crud';


$conn = new mysqli($hostname,$username,$password,$database);

// Check connection
if ($conn -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}
?>