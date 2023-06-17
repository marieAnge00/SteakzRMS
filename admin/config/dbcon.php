<?php

$host = "localhost";
$username = "root";
$password = "";
$database = "food";

$con = mysqli_connect("$host","$username","$password","$database");

if(!$con)
{
    die("<h1>Database Connection Failed</h1>");
}

function redirect($page, $message)
{
    $_SESSION['message'] = "$message";
    header("Location: $page");
    exit(0);
}
?>