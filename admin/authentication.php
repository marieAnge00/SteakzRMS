<?php
session_start();
include('config/dbcon.php');

if(!isset($_SESSION['auth']))
{
    $_SESSION['message'] = "Login to Access Dashboard";
    header("Location: ../login.php");
    exit(0);
}
else
{
    if($_SESSION['auth_role'] != "1")
    {
        $_SESSION['message'] = "You are not Authorised as ADMIN";
        header("Location: ../login.php");
        exit(0);
    }
}

?>
