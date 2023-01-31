<?php

require 'connectDB.php';

$date = date("Y-m-d");

$sql = "SELECT user_logs.id, users.cardId FROM user_logs INNER JOIN users ON users.id=user_logs.user_id WHERE user_logs.logDate='".$date."' AND user_logs.outTime='NA';";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    echo file_get_contents('http://rpi-server/rfidAccess/validateCard.php?cardId='.$row['cardId']);
}

$sql1 = "UPDATE officeStat SET officeOnOff=0;";
$result1 = mysqli_query($conn, $sql1);
setcookie('message','Office Turned Off',time()+5);
if (isset($_SERVER["HTTP_REFERER"])) {
    header("Location: " . $_SERVER["HTTP_REFERER"]);
}
