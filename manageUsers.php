<?php
session_start();
session_regenerate_id();
if(!isset($_SESSION['user']))
{
    header("Location: login.html");
}

require 'connectDB.php';
?>
<html>
<head>
    <title>
        Manage Users
    </title>
    <style>
        body {
            background-color: cyan;
        }
        h2 {
            text-align: center;
            font-family: algerian;
        }
        table {
            position:relative;
            left: 260px;
            border: 3px solid black;
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 60%;
            background-color: aqua;
        }

        td, th {
            border: 2px solid#1f1d1d;
            text-align: center;
            padding: 9px;
        }

        tr:nth-child(even) {
            background-color:white;
        }
    </style>
</head>
<body>
<?php include 'header.php';?>
<form style="position: absolute;" method="post" action="addUser.php">
    <label for="name">Name :- </label>
    <input type="text" id="name" name="name" value=""><br><br>
    <label for="E-mail">E-mail :</label>
    <input type="email" id="E-mail" name="email" value=""><br><br>
    <label for="Mobile No">Mobile:</label>
    <input type="tel" id="Mobile No" name="mobile" value=""><br><br>
    <label for="cardId">Card Id:</label>
    <input type="text" id="cardId" name="cardId" value=""><br><br>
    <button type="submit" id="submit">Submit</button>
    <button type="reset" id="reset" onclick="reset()">Reset</button>

    <div style="margin-top: 20px">
        <?php
        if(isset($_COOKIE['message'])){
            echo $_COOKIE['message'];
        }
        ?>
    </div>
</form>



<table>
    <tr>
        <th>Name</th>
        <th>Mobile</th>
        <th>Email</th>
        <th>Card Id</th>
        <th>Action</th>
    </tr>
    <?php
    $sql = "SELECT * FROM users ORDER BY name";
    $result = mysqli_query($conn, $sql);


    while ($row = mysqli_fetch_row($result)) {?>
        <tr>
            <td><?php echo $row[1]; ?></td>
            <td><?php echo $row[2]; ?></td>
            <td><?php echo $row[3]; ?></td>
            <td><?php echo $row[4]; ?></td>
            <td>
                <a href="deleteUser.php?id=<?php echo $row[0]; ?>" onclick="return confirm('Do you want to delete this record?');">Delete</a>
            </td>
        </tr>
        <?php
    }
    ?>
</table>

</body>
</html>