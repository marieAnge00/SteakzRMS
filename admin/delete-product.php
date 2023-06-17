<?php
include('authentication.php');

$id = $_GET['id'];
$query = "DELETE FROM products WHERE id='$id' ";
$query_run = mysqli_query($con, $query);

if($query_run)
{
    $_SESSION['message'] = "Product Deleted Successfully";
    header('Location: products.php');
}
?>

