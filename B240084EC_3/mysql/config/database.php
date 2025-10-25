<?php
if(session_status() == PHP_SESSION_NONE){
session_start();
}
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hotelbook";

$conn = mysqli_connect($servername, $username,'', $dbname);
if(!$conn){
die("Sorry we failed to connect: " . mysqli_connect_error());
}
?>