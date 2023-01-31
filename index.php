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
        Dashboard
    </title>
    <link rel="stylesheet" href="css/style.css">
	<style>
        .container-fluid{
            --bs-gutter-x: 1.5rem;
            --bs-gutter-y: 0;
            width: 100%;
            padding-right: calc(var(--bs-gutter-x) * 0.5);
            padding-left: calc(var(--bs-gutter-x) * 0.5);
            margin-right: auto;
            margin-left: auto;
        }
        .row {
            --bs-gutter-x: 1.5rem;
            --bs-gutter-y: 0;
            display: flex;
            flex-wrap: wrap;
            margin-top: calc(-1 * var(--bs-gutter-y));
            margin-right: calc(-0.5 * var(--bs-gutter-x));
            margin-left: calc(-0.5 * var(--bs-gutter-x));
        }
        .col-md-auto {
            flex: 0 0 auto;
            width: auto;
        }
        .col-md-1 {
            flex: 0 0 auto;
            width: 8.33333333%;
        }
        .col-md-2 {
            flex: 0 0 auto;
            width: 16.66666667%;
        }
        .col-md-3 {
            flex: 0 0 auto;
            width: 25%;
        }
        .col-md-4 {
            flex: 0 0 auto;
            width: 33.33333333%;
        }
        .col-md-5 {
            flex: 0 0 auto;
            width: 41.66666667%;
        }
        .col-md-6 {
            flex: 0 0 auto;
            width: 50%;
        }
        .col-md-7 {
            flex: 0 0 auto;
            width: 58.33333333%;
        }
        .col-md-8 {
            flex: 0 0 auto;
            width: 66.66666667%;
        }
        .col-md-9 {
            flex: 0 0 auto;
            width: 75%;
        }
        .col-md-10 {
            flex: 0 0 auto;
            width: 83.33333333%;
        }
        .col-md-11 {
            flex: 0 0 auto;
            width: 91.66666667%;
        }
        .col-md-12 {
            flex: 0 0 auto;
            width: 100%;
        }
        .rcorners1 {
            border-radius: 25px;
            background: #73AD21;
            padding: 20px;
            width: 200px;
            height: 170px;
            border: 2px solid black;
        }

        .rcorners2 {
            background: red;
            border-radius: 25px;
            border: 2px solid black;
            padding: 20px;
            width: 200px;
            height: 170px;
        }

        .rcorners3 {
            border-radius: 25px;
            border: 2px solid black;
            background: violet;
            padding: 20px;
            width: 200px;
            height: 170px;
        }

        p {
            font-size: 50px;
            text-align: center;
        }

        h1{
            text-align: center;
            font-family: algerian;
            background-color: aqua
        }
        h3 {
            font-size:20px;
        }
	</style>
</head>
<body>
<?php include 'header.php'; ?>
<div class="container-fluid">
	<?php
    $logDate = date("Y-m-d");

    $totalCountSql = "SELECT COUNT(*) as totalCount FROM users;";
    $totalResult = mysqli_query($conn, $totalCountSql);
    $totalResult = mysqli_fetch_assoc($totalResult);

	$presentCountSql = "SELECT COUNT(*) as presentCount FROM user_daily_timesheet INNER JOIN users ON users.id=user_daily_timesheet.user_id WHERE user_daily_timesheet.logDate='".$logDate."';";
    $presentResult = mysqli_query($conn, $presentCountSql);
    $presentResult = mysqli_fetch_assoc($presentResult);
	?>
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-2 " style="background-color: aqua;" >
			<div class="rcorners3">
				<div style="text-align:center;">
					<h3>Present Employee</h3>
					<p><?php echo $presentResult["presentCount"]; ?></p>
				</div>
			</div>
		</div><br>
		<div class="col-md-1"></div>
		<div class="col-md-2" style="background-color:aqua;"">
		<div class="rcorners2">
			<div style="text-align:center;">
				<h3>Absent Employee<sup style="font-size: 20px"></sup></h3>
				<p>
					<?php
					$absentCount = $totalResult["totalCount"] - $presentResult["presentCount"];
					echo $absentCount;
					?>
				</p>
			</div>
		</div>
	</div><br>
	<div class="col-md-1"></div>
	<div class="col-md-2" style="background-color: aqua;">
		<div class="rcorners1">
			<div style="text-align:center;">
				<h3>Total Employee</h3>
				<p><?php echo $totalResult["totalCount"];?></p>
			</div>
		</div>
	</div>
</div>
</body>
</html>
