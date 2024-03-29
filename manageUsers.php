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
    <input type="text" id="name" name="name" value="" required><br><br>
    <label for="E-mail">E-mail :</label>
    <input type="email" id="E-mail" name="email" value="" required><br><br>
    <label for="Mobile No">Mobile:</label>
    <input type="tel" id="Mobile No" name="mobile" value="" required><br><br>
    <label for="cardId">Card Id:</label>
    <input type="text" id="cardId" name="cardId" value="" required><br><br>
    <label for="tempCard">Temp Card:</label>
    <input type="text" id="tempCard" name="tempCard" value=""><br><br>
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
        <th>Temp Card</th>
		<th>Has Access</th>
		<th>Action</th>
    </tr>
    <?php
    $sql = "SELECT * FROM users ORDER BY name";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {?>
        <tr>
			<td><a style="text-decoration: none;" href="viewUserTimesheet.php?userid=<?php echo $row["id"]; ?>"><?php echo $row["name"]; ?></a></td>
            <td><?php echo $row["mobile"]; ?></td>
            <td><?php echo $row["email"]; ?></td>
            <td><?php echo $row["cardId"]; ?></td>
            <td><?php echo $row["tempCard"]; ?></td>
            <td><?php echo $row["hasAccess"]; ?></td>
            <td>
                <a href="editUserForm.php?id=<?php echo $row["id"]; ?>">Edit</a>
				&nbsp;&nbsp;
                <a href="deleteUser.php?id=<?php echo $row["id"]; ?>" onclick="return confirm('Do you want to delete this record?');">Delete</a>
            </td>
        </tr>
        <?php
    }
    ?>
</table>

</body>
</html>