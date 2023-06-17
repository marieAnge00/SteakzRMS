<?php
session_start();
if(!isset($_SESSION['auth']))
{
    $_SESSION['message'] = "Login to continue";
    header('Location: login.php');
    exit(0);
}

?>