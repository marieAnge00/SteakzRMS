<?php
session_start();
include('config/dbcon.php');

// Add Category
if(isset($_POST['add_category_btn']))
{
    // Check if image is not null
    if($_FILES['image']['name'] != '')
    {
        $name = $_POST['name'];
        $slug = $_POST['slug'];
        $description = $_POST['description'];
        $visibility = isset($_POST['visibility'])?'1':'0';
        $trending = isset($_POST['trending'])?'1':'0';

        $imagename = $_FILES['image']['name'];
        $allowed_exttension = array('gif', 'png','webp', 'jpg', 'jpeg');
        $image_extension = pathinfo($imagename, PATHINFO_EXTENSION);
        $filename = time().'.'.$image_extension;

        if (!in_array($image_extension, $allowed_exttension)) 
        {
            redirect("addcategory.php","You can add only jpg, png, webp, jpeg and gif files");
        }
        else
        {
            // Insert the category data
            $add_query = "INSERT INTO category (name,slug,description,image,status, trending) VALUES ('$name','$slug','$description','$filename','$visibility','$trending') ";
            $add_query_run = mysqli_query($con, $add_query);
        
            if($add_query_run)
            {
                // Move the image to uploads folder
                move_uploaded_file($_FILES["image"]["tmp_name"], "../uploads/".$filename);
                redirect("addcategory.php","Category added Successfully");

            }
            else
            {
                redirect("addcategory.php","Something went Wrong");
            }
        }
    }
    else
    {
        redirect("addcategory.php","Image field cannot be empty");
    }
    exit(0);
}
// Update Category
else if(isset($_POST['update_category_btn']))
{
    $category_id = $_POST['category_id']; 
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $description = $_POST['description'];
    $visibility = isset($_POST['visibility'])?'1':'0';
    $trending = isset($_POST['trending'])?'0':'1';
    $new_image = $_FILES['image']['name'];
    $old_image = $_POST['image_old'];

    if($new_image != '')
    {
        $filename = $new_image;
        $allowed_exttension = array('gif', 'png', 'webp','jpg', 'jpeg');
        $filename = $_FILES['image']['name'];
        $file_extension = pathinfo($filename, PATHINFO_EXTENSION);
        if (!in_array($file_extension, $allowed_exttension)) 
        {
            redirect("edit-category.php?id=".$category_id ,"You can add only jpg, png,webp, jpeg and gif files");
            exit(0);
        }
    }
    else
    {
        $filename = $old_image;
    }

    // Update the category data
    $update_query = "UPDATE category SET name='$name', slug='$slug',description='$description', image='$filename', status='$visibility', trending='$trending' WHERE id='$category_id' ";
    $update_query_run = mysqli_query($con, $update_query);
    if($update_query_run)
    {
        if($new_image !='')
        {
            move_uploaded_file($_FILES["image"]["tmp_name"], "../uploads/".$_FILES["image"]["name"]);
            unlink("../uploads/".$old_image);
        }
        redirect("category.php", "Data Updated Successfully");
    }
    else
    {
        redirect("category.php","Something went Wrong");
    }
}
// Add Product
else if(isset($_POST['add_product_btn']))
{
    if($_FILES['image']['name'] != '')
    {
        $category_id = $_POST['category_id'];
        $type = $_POST['type'];
        $name = $_POST['name'];
        $slug = $_POST['slug'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $visibility = isset($_POST['visibility'])?'1':'0';
        $trending = isset($_POST['trending'])?'0':'1';
        $today_special = isset($_POST['today_special'])?'0':'1';
        $availability_status = isset($_POST['availability_status'])?'1':'0';
        $imagename = $_FILES['image']['name'];
        $allowed_exttension = array('gif', 'png', 'jpg','webp', 'jpeg');
        $image_extension = pathinfo($imagename, PATHINFO_EXTENSION);
        $filename = time().'.'.$image_extension;
        
        if(!in_array($image_extension, $allowed_exttension))
        {
            redirect("addproduct.php","You can add only jpg, png, webp,jpeg and gif files");
        }
        else
        {
            // Insert the product data
            $add_query = "INSERT INTO products (category_id,name,slug,description,price,image,today_special,type,availability_status, trending,status) 
            VALUES ('$category_id','$name','$slug','$description','$price','$filename','$today_special','$type','$availability_status','$trending','$visibility') ";
            $add_query_run = mysqli_query($con, $add_query);
        
            if($add_query_run)
            {
                // Move the image to uploads folder
                move_uploaded_file($_FILES["image"]["tmp_name"], "../uploads/".$filename);
                redirect("addproduct.php","Product added Successfully");
            }
            else
            {
                redirect("addproduct.php","Something went Wrong");
            }
        }
    }
    else
    {
        redirect("addproduct.php","Image field cannot be empty");
    }
    exit(0);

}
// Update Product
else if(isset($_POST['update_product_btn']))
{
    $product_id = $_POST['product_id'];
    $category_id = $_POST['category_id'];
    $type = $_POST['type'];
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $visibility = isset($_POST['visibility'])?'1':'0';
    $trending = isset($_POST['trending'])?'0':'1';
    $today_special = isset($_POST['today_special'])?'0':'1';
    $availability_status = isset($_POST['availability_status'])?'1':'0';
    $old_image = $_POST['image_old'];

    if($_FILES['image']['name'] != '')
    {
        $imagename = $_FILES['image']['name'];
        $allowed_exttension = array('gif', 'png', 'jpg','webp', 'jpeg');
        $image_extension = pathinfo($imagename, PATHINFO_EXTENSION);
        $filename = time().'.'.$image_extension;
        
        if(!in_array($image_extension, $allowed_exttension))
        {
            redirect("edit-product.php?id=".$product_id,"You can add only jpg, png, webp, jpeg and gif files");

        }
    }
    else
    {
        $filename = $old_image;
    }

    if(empty($category_id) || empty($type) || empty($name) || empty($slug) || empty($price) || empty($description))
    {
        redirect("edit-product.php?id=".$product_id,"All fields are required");
    }
    else
    {
        // Update the product data
        $update_query = "UPDATE products SET category_id='$category_id', name='$name',slug='$slug', 
        description='$description',price='$price',image='$filename',today_special='$today_special',type='$type',availability_status='$availability_status', trending='$trending',
        status='$visibility' WHERE id='$product_id' ";
        $update_query_run = mysqli_query($con, $update_query);
    
        if($update_query_run)
        {
            if($imagename !='')
            {
                // Move the image to uploads folder
                move_uploaded_file($_FILES["image"]["tmp_name"], "../uploads/".$filename);
                unlink("../uploads/".$old_image);
            }
            redirect("edit-product.php?id=".$product_id,"Product Updated Successfully");
        }
        else
        {
            redirect("addproduct.php","Something went Wrong");
        }
    }
    exit(0);

}
// Update Order status
else if(isset($_POST['update_order_btn']))
{
    $order_status = $_POST['order_status'];
    $tracking_no = $_POST['tracking_no'];
    $cancel_reason = $_POST['cancel_reason'];

    if($order_status == '2' && $cancel_reason == '')
    {
        redirect("order-view.php?tracking_no=$tracking_no","To Cancel Order, Please specify the cancel reason");
        die();
    }
    else if($order_status == '2')
    {

        $order_query = "SELECT * FROM orders WHERE tracking_no='$tracking_no' ";
        $order_query_run = mysqli_query($con,$order_query);

        if(mysqli_num_rows($order_query_run) > 0)
        {
            $update_order_query = "UPDATE orders SET status='$order_status', cancel_reason='$cancel_reason' WHERE tracking_no='$tracking_no' ";
            $update_order_query_run = mysqli_query($con, $update_order_query);

            if($update_order_query_run)
            {
                redirect("order-view.php?tracking_no=$tracking_no","Order Status Updated Successfully");
            }
            else
            {
                redirect("order-view.php?tracking_no=$tracking_no","Something Went Wrong");
            }
        }
        else
        {
            redirect("order-view.php?tracking_no=$tracking_no","Something Went Wrong");
        }
    }
    else if($order_status == '1')
    {
        // While updating an order status to "Completed", We will check the order's payment_mode.
        // If it is an online payment, the payment_status will already be 1. For COD orders, We will update 
        // the payment Status to 1 after the order is completed and cash is received from the customer 

        $order_query = "SELECT * FROM orders WHERE tracking_no='$tracking_no' ";
        $order_query_run = mysqli_query($con,$order_query);

        $order_data = mysqli_fetch_array($order_query_run);
        
        if($order_data['payment_mode'] == 'COD')
        {
            // Update payment status
            $update_payment_query = "UPDATE orders SET payment_status='1' WHERE tracking_no='$tracking_no'";
            $update_payment_query_run = mysqli_query($con,$update_payment_query);
        }

        $update_order_query = "UPDATE orders SET status='$order_status', cancel_reason='$cancel_reason' WHERE tracking_no='$tracking_no' ";
        $update_order_query_run = mysqli_query($con, $update_order_query);

        if($update_order_query_run)
        {
            redirect("order-view.php?tracking_no=$tracking_no","Order Status Updated Successfully");
        }
        else
        {
            redirect("order-view.php?tracking_no=$tracking_no","Something Went Wrong");
        }
    }

    redirect("order-view.php?tracking_no=$tracking_no","Something went wrong");
    die();

}
// Update User Data
else if(isset($_POST['update_user_data']))
{
    $user_id = mysqli_real_escape_string($con,$_POST['user_id']);
    $fname =  mysqli_real_escape_string($con,$_POST['fname']);
    $lname =  mysqli_real_escape_string($con,$_POST['lname']);
    $phone =  mysqli_real_escape_string($con,$_POST['phone']);
    $status =  mysqli_real_escape_string($con,$_POST['status']) ? '1':'0';
    $role_as =  mysqli_real_escape_string($con,$_POST['role_as']);

    if($fname == "" || $lname == "" || $phone =="")
    {
        if(!is_numeric($phone))
        {
            $_SESSION['message'] = "The Contact No field can contain only integers";
        }
        else{
            $_SESSION['message'] = "All fields are mandatory";
        }
        header("Location: edit-user.php?id=$user_id");
        exit(0);
    }
    else
    {
        $update_user_query = "UPDATE users SET fname='$fname',lname='$lname',phone='$phone',role_as='$role_as',status='$status' WHERE id='$user_id' ";
        $update_user_query_run = mysqli_query($con,$update_user_query);

        if($update_user_query_run)
        {
            redirect("edit-user.php?id=$user_id","User data Udpated Successfully");
            exit(0);
        }
        else
        {
            redirect("edit-user.php?id=$user_id","Something Went Wrong");
            exit(0);
        }
    }
}
else
{
    header("Location: index.php");
    exit(0);
}

?>