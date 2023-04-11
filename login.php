<?php
session_start();
if( isset($_POST['username']) && isset($_POST['password']) )
{
    if( auth($_POST['username'], $_POST['password']) )
    {
        // auth okay, setup session
        $_SESSION['user'] = $_POST['username'];

        header( "Location: index.php" );
    } else {
        header( "Location: login.html" );
    }
} else {
    // username and password not given so go back to login
    header( "Location: login.html" );
}

function auth($username,$password){
    if($username=='admin' && $password=='password')
    {
        return true;
    }
    return false;
}