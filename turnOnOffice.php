<?php

require 'connectDB.php';

$sql3 = "UPDATE officeStat SET officeOnOff=1;";
$result3 = mysqli_query($conn, $sql3);

setcookie('message','Office Turned On',time()+5);

if (isset($_SERVER["HTTP_REFERER"])) {
    header("Location: " . $_SERVER["HTTP_REFERER"]);
}

