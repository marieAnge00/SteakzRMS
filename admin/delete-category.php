<?php
include('authentication.php');

$id = $_GET['id'];
$query = "DELETE FROM category WHERE id='$id' ";
$query_run = mysqli_query($con, $query);

if($query_run)
{
    $_SESSION['message'] = "Category Deleted Successfully";
    header('Location: category.php');
}
?>

