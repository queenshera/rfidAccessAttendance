<?php

require 'connectDB.php';

$sql3 = "UPDATE officeStat SET officeOnOff=0;";
$result3 = mysqli_query($conn, $sql3);

setcookie('message','Office Turned Off',time()+5);

if (isset($_SERVER["HTTP_REFERER"])) {
    header("Location: " . $_SERVER["HTTP_REFERER"]);
}
