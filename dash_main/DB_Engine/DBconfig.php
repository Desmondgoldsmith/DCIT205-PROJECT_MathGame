<?php

$server = "localhost";
 $username = "root";
 $password = "";
 $database = "mathgame";
 $conn=mysqli_connect($server,$username,$password,$database);
if(!$conn){
 die('Could not Connect MySql:');
}
?>