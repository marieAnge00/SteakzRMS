<?php
session_start();
include('../admin/config/dbcon.php');

if(isset($_SESSION['auth_user']))
{
    $user_id = $_SESSION['auth_user']['user_id'];
    
    if($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        if(isset($_POST['scope']))
        {
            $scope = $_POST['scope'];
            if($scope == "get_total")
            {
                $total_price = 0;
                $user_cart_query = "SELECT c.id as cid, c.product_id, c.product_qty, c.user_id , p.id as pid, p.name, p.price, p.status FROM carts c, products p WHERE c.user_id='$user_id' AND p.id=c.product_id ";
                $user_cart_query_run = mysqli_query($con, $user_cart_query);

                foreach($user_cart_query_run as $item)
                {
                    $total_price += $item['price'] * $item['product_qty'];
                }

                echo $total_price;
            }
            else if($scope == "placeorder")
            {
                // store order
                $fname = mysqli_real_escape_string($con,$_POST['fname']);
                $lname = mysqli_real_escape_string($con,$_POST['lname']);
                $phone = mysqli_real_escape_string($con,$_POST['phone']);
                $pincode = mysqli_real_escape_string($con,$_POST['pincode']);
                $address = mysqli_real_escape_string($con,$_POST['address']);
                $user_message = mysqli_real_escape_string($con,$_POST['user_message']);
                $payment_mode = mysqli_real_escape_string($con,$_POST['payment_mode']);
                $payment_id = $_POST['payment_id'];
    
                $tracking_no = substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(25/strlen($x)) )),1,25);
    
                $total_price = 0;
                $user_cart_query = "SELECT c.id as cid, c.product_id, c.product_qty, c.user_id , p.id as pid, p.name, p.price, p.status FROM carts c, products p WHERE c.user_id='$user_id' AND p.id=c.product_id ";
                $user_cart_query_run = mysqli_query($con, $user_cart_query);

                foreach($user_cart_query_run as $item)
                {
                    $total_price += $item['price'] * $item['product_qty'];
                }

                // Insert order data - Place Order
                $place_order_query = "INSERT INTO orders (user_id,fname,lname,phone,pincode,address,user_message,total_price,payment_id,payment_mode,payment_status,tracking_no)
                 VALUES ('$user_id','$fname','$lname','$phone','$pincode','$address','$user_message','$total_price','$payment_id','$payment_mode','1','$tracking_no')";
                $place_order_query_run = mysqli_query($con, $place_order_query);
                
                if($place_order_query_run)
                {
                    $order_id = mysqli_insert_id($con);
    
                    $user_cart_query = "SELECT c.id as cid, c.product_id, c.product_qty, c.user_id , p.id as pid, p.name, p.price, p.status FROM carts c, products p WHERE c.user_id='$user_id' AND p.id=c.product_id ";
                    $user_cart_query_run = mysqli_query($con, $user_cart_query);
    
                    foreach($user_cart_query_run as $item)
                    {
                        $product_id = $item['pid'];
                        $product_qty = $item['product_qty'];
                        $product_price = $item['price'];
                        
                        // Insert order items data
                        $order_items_query = "INSERT INTO order_items (order_id,prod_id,prod_qty,prod_price) VALUES ('$order_id','$product_id','$product_qty','$product_price')";
                        $order_items_query_run = mysqli_query($con, $order_items_query);
                    }
    
                    // Clear user's cart
                    $clear_cart_query = "DELETE FROM carts WHERE user_id='$user_id' ";
                    $clear_cart_query_run = mysqli_query($con, $clear_cart_query);
    
                    $data = [
                        'message' => "Order placed Successfully",
                        'icon' => "success"
                    ];
                }
                else
                {
                    $data = [
                        'message' => "Something Went wrong",
                        'icon' => "error"
                    ];
                }
                echo json_encode($data);
          
            }
        }
        else
        {
            echo "Something went wrong";
        }
        
    }
}
?>