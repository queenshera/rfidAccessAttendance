<?php

require 'connectDB.php';

$sql = "SELECT * FROM officeStat";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $result = mysqli_fetch_assoc($result);
    echo 'office '.$result["officeOnOff"];

}

