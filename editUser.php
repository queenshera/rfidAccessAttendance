<?php
session_start();
session_regenerate_id();
if (!isset($_SESSION['user'])) {
    header("Location: login.html");
}

require 'connectDB.php';

if (isset($_POST['id']) && isset($_POST['name']) && isset($_POST['mobile']) && isset($_POST['email']) && isset($_POST['cardId'])) {

    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $cardId = $_POST['cardId'];
    $tempCard = $_POST['tempCard'];
    $hasAccess = $_POST['hasAccess'];

    $sql = "SELECT * FROM users WHERE NOT id='" . $id . "' AND (cardId='" . $cardId . "' or tempCard='" . $tempCard . "') AND hasAccess='Yes'";
    $result = mysqli_query($conn, $sql);

    print_r(mysqli_fetch_assoc($result));
    return;

    if (mysqli_num_rows($result) == 0) {
        $sql2 = "UPDATE users SET name='".$name."', email='".$email."', mobile='".$mobile."', cardId='".$cardId."', tempCard='".$tempCard."', hasAccess='".$hasAccess."' WHERE id=".$id.";";
        $result2 = mysqli_query($conn, $sql2);

        setcookie('message', 'User updated successfully', time() + 5);

        header("Location: manageUsers.php");
    } else {
        setcookie('message', 'Card Id exists already', time() + 5);
        header("Location: manageUsers.php");
    }
}
