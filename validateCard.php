<?php

//Connect to database
require 'connectDB.php';

if (isset($_GET['timestamp'])) {
    $timestamp = $_GET['timestamp'];
    $date = date("Y-m-d", $timestamp);

} else {
    $timestamp = time();
    $date = date("Y-m-d");
}

if (isset($_GET['cardId'])) {
    $sql = "SELECT * FROM officeStat";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    if ($row['officeOnOff'] == 0) {
        echo 'denied';

        if (isset($_GET['referer'])) {
            header("Location: " . $_GET["referer"]);
        }
        return;
    }


    $cardId = $_GET['cardId'];

    $sql = "SELECT * FROM users WHERE cardId='" . $cardId . "'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $result = mysqli_fetch_assoc($result);
        echo 'granted ' . $result["name"];

        $sql2 = "SELECT * FROM user_logs WHERE user_id='" . $result['id'] . "' AND logDate='" . $date . "' AND outTime='NA';";
        $result2 = mysqli_query($conn, $sql2);

        if (mysqli_num_rows($result2) > 0) {
            $result2 = mysqli_fetch_assoc($result2);
            $sql3 = "UPDATE user_logs SET outTime='" . $timestamp . "' WHERE id='" . $result2["id"] . "' AND outTime='NA';";
            $result3 = mysqli_query($conn, $sql3);

            $sql4 = "SELECT * from user_daily_timesheet where user_id='" . $result['id'] . "' AND logDate='" . $date . "';";
            $result4 = mysqli_query($conn, $sql4);

            if (mysqli_num_rows($result4) > 0) {
                $result4 = mysqli_fetch_assoc($result4);
                $currentSittingTime = ($timestamp - $result2["inTime"]);

                $totalSittingTime = $result4["sittingTime"] + $currentSittingTime;

                $sql5 = "UPDATE user_daily_timesheet SET sittingTime='" . $totalSittingTime . "' WHERE id='" . $result4["id"] . "';";
                $result5 = mysqli_query($conn, $sql5);
            } else {
                $sql5 = "INSERT INTO user_daily_timesheet (user_id,logDate) values ('" . $result["id"] . "','" . $date . "')";
                $result5 = mysqli_query($conn, $sql5);
            }
        } else {
            $sql3 = "SELECT * FROM user_logs WHERE user_id='" . $result["id"] . "' AND logDate='" . $date . "' ORDER BY id DESC";
            $result3 = mysqli_query($conn, $sql3);
            $result3 = mysqli_fetch_assoc($result3);

            $sql4 = "INSERT INTO user_logs (user_id,logDate,inTime) values ('" . $result["id"] . "','" . $date . "','" . $timestamp . "')";
            $result4 = mysqli_query($conn, $sql4);

            $sql5 = "SELECT * from user_daily_timesheet where user_id='" . $result['id'] . "' AND logDate='" . $date . "';";
            $result5 = mysqli_query($conn, $sql5);

            if (mysqli_num_rows($result5) > 0) {
                $result5 = mysqli_fetch_assoc($result5);
                if (isset($result3["outTime"])) {
                    $currentBreakTime = ($timestamp - $result3["outTime"]);
                    $totalBreakTime = $result5["breakTime"] + $currentBreakTime;

                    $sql6 = "UPDATE user_daily_timesheet SET breakTime='" . $totalBreakTime . "' WHERE id='" . $result5["id"] . "';";
                    $result6 = mysqli_query($conn, $sql6);
                }

            } else {
                $sql5 = "INSERT INTO user_daily_timesheet (user_id,logDate) values ('" . $result["id"] . "','" . $date . "')";
                $result5 = mysqli_query($conn, $sql5);
            }
        }
    } else {
        echo 'denied';
    }
} else {
    echo 'denied';
}

if (isset($_GET['referer'])) {
    header("Location: " . $_GET["referer"]);
}
?>

