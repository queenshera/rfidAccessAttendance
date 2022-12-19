<?php
session_start();
session_regenerate_id();
if(!isset($_SESSION['user']))
{
    header("Location: login.html");
}

require 'connectDB.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];

    $sql = "SELECT * FROM users WHERE id='".$id."'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $sql = "DELETE FROM users WHERE id='".$id."'";
        $result = mysqli_query($conn, $sql);

        setcookie('message','User deleted successfully',time()+5);

        header("Location: manageUsers.php");
    }
    else{
        setcookie('message','User does not exists',time()+5);
        header("Location: manageUsers.php");
    }
}
