<?php
session_start();
session_regenerate_id();

if(!isset($_GET['logDate']))      // if there is no valid session
{
    header("Location: dailyTs.php?logDate=".date("Y-m-d"));
}

require 'connectDB.php';

?>
<!doctype html>
<head>
	<title>
		Daily Timesheet
	</title>
	<meta http-equiv="refresh" content="10">
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
<h2>Access Controll & Attendance </h2>
<br>
<div style="text-align:center;">
	<form method="get" action="dailyTs.php">
		Date: <input type="date" name="logDate" required>
		<input type="submit" value="submit">
	</form>
</div>
<br>
<table>
	<tr>
		<th>Name</th>
		<th>Date</th>
		<th>Office seating time</th>
		<th>Break time</th>
		<th>Total Duration</th>
		<th>Status</th>
	</tr>
    <?php
	$logDate = $_GET["logDate"];
	$logDate = date("Y-m-d", strtotime($logDate) );
    $sql = "SELECT users.name, users.cardId, user_daily_timesheet.* FROM user_daily_timesheet INNER JOIN users ON users.id=user_daily_timesheet.user_id WHERE user_daily_timesheet.logDate='".$logDate."';";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {?>
		<tr>
			<td><?php echo $row["name"]; ?></td>
			<td><?php echo $row["logDate"]; ?></td>
			<td>
				<?php
                $sql2 = "SELECT * FROM user_logs WHERE user_id='".$row['user_id']."' AND logDate='".$logDate."' AND outTime='NA';";
                $result2 = mysqli_query($conn, $sql2);

                $sittingTime = $row["sittingTime"];

				if($rowCount = mysqli_num_rows($result2)>0)
				{
					$result2 = mysqli_fetch_assoc($result2);
					$inTime = $result2["inTime"];
					$inDuration = time() - $inTime;

					$sittingTime += $inDuration;
                }

                $hours = floor($sittingTime / 3600);
                $minutes = floor(($sittingTime / 60) % 60);
                $seconds = $sittingTime % 60;

                echo $hours.' hours '.$minutes.' minutes '.$seconds.' seconds';
				?>
			</td>
			<td>
                <?php
                $breakTime = $row["breakTime"];
                $hours = floor($breakTime / 3600);
                $minutes = floor(($breakTime / 60) % 60);
                $seconds = $breakTime % 60;

                echo $hours.' hours '.$minutes.' minutes '.$seconds.' seconds';
                ?>
			</td>
			<td>
                <?php
                $init = $sittingTime + $breakTime;
                $hours = floor($init / 3600);
                $minutes = floor(($init / 60) % 60);
                $seconds = $init % 60;

                echo $hours.' hours '.$minutes.' minutes '.$seconds.' seconds';
                ?>
			</td>
			<td>
				<?php
                if($rowCount>0)
                {
				?>
					<span style="background-color: yellowgreen; border-radius: 40px;padding:5px;">P</span>
				<?php
                }
				else {
				?>
					<span style="background-color: orangered; border-radius: 40px;padding:5px;">A</span>
				<?php
                }

				?>
			</td>
		</tr>
        <?php
    }
    ?>
</table>
</body>
</html>