<?php
session_start();

if(isset($_SESSION['auth']))
{
    // session_destroy();
    unset( $_SESSION['auth']);
    unset( $_SESSION['auth_role']);
    unset( $_SESSION['auth_user']);

    $_SESSION['message'] = "Logged Out Successfully";
    header("Location: ../login.php");
    exit(0);
}
else
{
    header("Location: index.php");
    exit(0);
}

?>