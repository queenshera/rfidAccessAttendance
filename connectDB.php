<?php
/* Database connection settings */
$servername = "localhost";
$username = "admin";		//put your phpmyadmin username.(default is "root")
$password = "Qsit@1234";			//if your phpmyadmin has a password put it here.(default is "root")
$dbname = "rfidDb";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if($conn === false)
{
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$currentUrl =  isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https://" : "http://";

$currentUrl .= $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

//date_default_timezone_set('Asia/Kolkata');
?>

