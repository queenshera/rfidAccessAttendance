<?php
session_start();
session_regenerate_id();
if(!isset($_SESSION['user']))
{
    header("Location: login.html");
}

require 'connectDB.php';

if (isset($_POST['name']) && isset($_POST['mobile']) && isset($_POST['email']) && isset($_POST['cardId'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $cardId = $_POST['cardId'];

    $sql = "SELECT * FROM users WHERE cardId='".$cardId."'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) <= 0) {
        $sql = "INSERT INTO users (name, email,mobile,cardId) VALUES ('$name','$email','$mobile','$cardId')";
        $result = mysqli_query($conn, $sql);

        setcookie('message','Card added successfully',time()+5);

        header("Location: manageUsers.php");
    }
    else{
        setcookie('message','Card Id exists already',time()+5);
        header("Location: manageUsers.php");
    }
}
