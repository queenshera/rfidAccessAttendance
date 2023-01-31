<h2>Access Controll & Attendance </h2>
<div class="topnav">
    <a href="index.php">Dashboard</a>
    <a href="dailyLog.php?logDate=<?php echo date('Y-m-d'); ?>">Daily Log</a>
    <a href="dailyTimesheet.php?logDate=<?php echo date('Y-m-d'); ?>">Daily Timesheet</a>
    <a href="manageUsers.php">Manage Users</a>

    <?php
    $sql = "SELECT * FROM officeStat";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $result = mysqli_fetch_assoc($result);

        if($result["officeOnOff"])
        {
            ?>
            <a href="turnOffOffice.php">Turn Off Office</a>
            <?php
        }
        else
        {
            ?>
            <a href="turnOnOffice.php">Turn On Office</a>
            <?php
        }
    }
    ?>

    <a href="logout.php">Logout</a>
</div>

<br>
