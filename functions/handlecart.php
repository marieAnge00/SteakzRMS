<?php
    session_start();
    include('../admin/config/dbcon.php');

    if(isset($_SESSION['auth_user']))
    {
        if(isset($_POST['scope']))
        {
            $scope = $_POST['scope'];
            $user_id = $_SESSION['auth_user']['user_id'];

            switch ($scope) 
            {
                case 'addtocart':
                    $product_id = mysqli_real_escape_string($con,$_POST['product_id']);                
                    $product_qty = mysqli_real_escape_string($con,$_POST['product_qty']);             
                    
                    // Check if product exists with given Product ID
                    $check_prod_exists_query = "SELECT * FROM products WHERE id='$product_id' AND status='0' ";
                    $check_prod_exists_query_run = mysqli_query($con, $check_prod_exists_query);

                    if(mysqli_num_rows($check_prod_exists_query_run) > 0)
                    {
                        // Check if already exists product already exists
                        $chk_exist_in_cart_query = "SELECT * FROM carts WHERE product_id='$product_id' AND user_id='$user_id' ";
                        $chk_exist_in_cart_query_run = mysqli_query($con, $chk_exist_in_cart_query);
        
                        if(mysqli_num_rows($chk_exist_in_cart_query_run) > 0)
                        {
                            echo "Product already added to cart";
                        }
                        else
                        {
                            $add_to_cart_query = "INSERT INTO carts (`product_id`,`user_id`,`product_qty`) VALUES ('$product_id','$user_id','$product_qty')";
                            $add_to_cart_query_run = mysqli_query($con, $add_to_cart_query);

                            if($add_to_cart_query_run)
                            {
                                echo "Product added to cart";
                            }
                            else
                            {
                                echo "Something went Wrong";
                            }
                        }
                    }

                    break;
                case 'removefromcart' :

                    $cart_id = mysqli_real_escape_string($con,$_POST['cart_id']);                
                    
                    // Check if product exists in users cart
                    $chk_exist_in_cart_query = "SELECT * FROM carts WHERE id='$cart_id' AND user_id='$user_id' ";
                    $chk_exist_in_cart_query_run = mysqli_query($con, $chk_exist_in_cart_query);
    
                    if(mysqli_num_rows($chk_exist_in_cart_query_run) > 0)
                    {
                        $remove_from_cart_query = "DELETE FROM carts WHERE id='$cart_id' ";
                        $remove_from_cart_query_run = mysqli_query($con, $remove_from_cart_query);

                        if($remove_from_cart_query_run)
                        {
                            echo "Product removed from cart";
                        }
                        else
                        {
                            echo "Something went Wrong";
                        }
                    }
                    else
                    {
                        echo "Something Went wrong";
                    }

                    break;

                case 'updatequantity': 
                     
                    $product_id = mysqli_real_escape_string($con,$_POST['product_id']);                
                    $product_qty = mysqli_real_escape_string($con,$_POST['product_qty']);             
                   
                    // Check if product exists in users cart
                    $chk_exist_in_cart_query = "SELECT * FROM carts WHERE product_id='$product_id' AND user_id='$user_id' ";
                    $chk_exist_in_cart_query_run = mysqli_query($con, $chk_exist_in_cart_query);
    
                    if(mysqli_num_rows($chk_exist_in_cart_query_run) > 0 && $product_qty > 0)
                    {
                        $update_cart_query = "UPDATE carts SET product_qty='$product_qty' WHERE product_id='$product_id' AND user_id='$user_id' ";
                        $update_cart_query_run = mysqli_query($con, $update_cart_query);
                    }
                    else
                    {
                        echo "Something Went wrong";
                    }

                    break;

                default:
                    echo "Something Went wrong";
                    break;
            }
        }
        else
        {
            header('Location: ../index.php');
        }
    }
    else
    {
        if(isset($_POST['scope']))
        {
            echo "Login to continue";        
        }
        else
        {
            header('Location: ../login.php');
        }

    }

?>