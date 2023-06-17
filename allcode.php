<?php
session_start();
include('admin/config/dbcon.php');


if(isset($_POST['logout_btn']))
{
    // session_destroy();
    unset( $_SESSION['auth']);
    unset( $_SESSION['auth_role']);
    unset( $_SESSION['auth_user']);

    $_SESSION['message'] = "Logged Out Successfully";
    header("Location: login.php");
    exit(0);
}
// Cancel Order Button
else if(isset($_POST['cancel_order_btn']))
{
    $user_id = $_SESSION['auth_user']['user_id'];
    $tracking_no =  mysqli_real_escape_string($con,$_POST['tracking_no']);
    $cancel_reason =  mysqli_real_escape_string($con,$_POST['cancel_reason']);

    // Check tracking number is valid and belongs to the logged in user
    $order_query = "SELECT * FROM orders WHERE tracking_no='$tracking_no' AND user_id='$user_id' ";
    $order_query_run = mysqli_query($con,$order_query);

    if($order_query_run)
    {
        if(mysqli_num_rows($order_query_run) > 0)
        {
            if($cancel_reason != "")
            {
                // Cancel Order
                $cancel_query = "UPDATE orders SET status='2', cancel_reason='$cancel_reason' WHERE tracking_no='$tracking_no' AND status='0' ";
                $cancel_query_run = mysqli_query($con, $cancel_query);
            
                if($cancel_query_run)
                {
                    $_SESSION['message'] = "Order cancelled";
                    header("Location: vieworder.php?t=$tracking_no");
                    exit(0);
                }
            }
            else
            {
                $_SESSION['message'] = "Please fill the Cancel Reason Box to cancel your order";
                header("Location: vieworder.php?t=$tracking_no");
                exit(0);
            }
        }
        else
        {
            $_SESSION['message'] = "Something Went Wrong";
            header("Location: vieworder.php?t=$tracking_no");
            exit(0);
        }
    }
}
// Update User Profile
else if(isset($_POST['update_user_details']))
{
    $user_id = $_SESSION['auth_user']['user_id'];
    $fname =  mysqli_real_escape_string($con,$_POST['fname']);
    $lname =  mysqli_real_escape_string($con,$_POST['lname']);
    $phone =  mysqli_real_escape_string($con,$_POST['phone']);

    if($fname == "" || $lname == "" || $phone =="")
    {
        if(!is_numeric($phone))
        {
            $_SESSION['message'] = "The Contact No field can contain only integers";
        }
        else{
            $_SESSION['message'] = "All fields are mandatory";
        }
        header("Location: myprofile.php");
        exit(0);
    }
    else
    {
        $user_query = "UPDATE users SET fname='$fname',lname='$lname',phone='$phone' WHERE id='$user_id' ";
        $user_query_run = mysqli_query($con,$user_query);

        if($user_query_run)
        {
            $_SESSION['message'] = "Profile Udpated Successfully";
        }
        else
        {
            $_SESSION['message'] = "Something Went Wrong";
        }
        header("Location: myprofile.php");
        exit(0);
    }
}
else
{
    header("Location: index.php");
    exit(0);
}

?>