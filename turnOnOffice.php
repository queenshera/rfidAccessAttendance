<?php

require 'connectDB.php';

/*$date = date("Y-m-d");

$sql1 = "SELECT * FROM users;";
$result1 = mysqli_query($conn, $sql1);

while ($row = mysqli_fetch_assoc($result1)) {
    $sql2 = "INSERT INTO user_daily_timesheet (user_id,logDate) values ('" . $row["id"] . "','" . $date . "')";
    $result2 = mysqli_query($conn, $sql2);
}*/

$sql3 = "UPDATE officeStat SET officeOnOff=1;";
$result3 = mysqli_query($conn, $sql3);

setcookie('message','Office Turned On',time()+5);

if (isset($_SERVER["HTTP_REFERER"])) {
    header("Location: " . $_SERVER["HTTP_REFERER"]);
}

