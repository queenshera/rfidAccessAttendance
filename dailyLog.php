<?php
session_start();
session_regenerate_id();
if(!isset($_SESSION['user']))      // if there is no valid session
{
    header("Location: login.html");
}

require 'connectDB.php';

?>
<!doctype html>
<head>
    <title>
        User Logs
    </title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include 'header.php'; ?>
<div style="text-align:center;">
	<form method="get" action="dailyLog.php">
		Date: <input type="date" name="logDate" required>
		<input type="submit" value="submit">
	</form>
</div>
<br>
<table>
    <tr>
<!--        <th>ID</th>-->
        <th>Name</th>
        <th>Date</th>
        <th>Intime</th>
        <th>Out time</th>
        <th>Duration</th>
    </tr>
    <?php
    $sql = "SELECT users.name, user_logs.* FROM user_logs INNER JOIN users ON users.id=user_logs.user_id WHERE user_logs.logDate='".$_GET['logDate']."';";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {?>
        <tr>
<!--            <td>--><?php //echo $row["id"]; ?><!--</td>-->
            <td><?php echo $row["name"]; ?></td>
            <td><?php echo $row["logDate"]; ?></td>
            <td><?php echo $dateTime1 = date('Y-m-d h:i:s a',$row["inTime"]) ?></td>
            <td>
                <?php
                    if($row["outTime"] == 'NA') {
                        echo 'NA';
                        $dateTime2 = date('Y-m-d H:i:s',time());
                    }
                    else {
                        echo $dateTime2 = date('Y-m-d h:i:s a',$row["outTime"]);
                    }
                ?>
            </td>
            <td>
                <?php
                    $dateTime1 = new DateTime($dateTime1);
                    $dateTime2 = new DateTime($dateTime2);
                    $interval = $dateTime1->diff($dateTime2);
                    $elapsed = $interval->format('%h hours %i minutes %s seconds');
                    echo $elapsed;
                ?>
            </td>
        </tr>
        <?php
    }
    ?>

</table>
</body>
</html>