<?php
    include('functions/authentication.php');
    include('includes/header.php');
?>


<div class="banner-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="banner-heading">Orders</h3>
            </div>
        </div>
    </div>
</div>

<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <h4 class="main-heading">My <span class="text-orange">Orders</span></h4>
                <div class="underline mb-4"></div>
                
                <?php 
                    $user_id = $_SESSION['auth_user']['user_id'];
                    $orders_query = "SELECT * FROM orders WHERE user_id='$user_id' ORDER BY id DESC";
                    $orders_query_run = mysqli_query($con, $orders_query);

                    if($orders_query_run)
                    {
                        if(mysqli_num_rows($orders_query_run) > 0)
                        {
                            foreach($orders_query_run as $row)
                            {
                                ?>

                                    <div class="cart-page-section">
                                        <div class="row product_data">
                                            <div class="col-md-4 mbrdr my-auto">
                                                <h6 class="fw-bold mb-0 mb-md-1">Tracking No:</h6>
                                                <label class=""><?= $row['tracking_no']; ?></label>
                                            </div>
                                            <div class="col-md-2 mbrdr my-auto">
                                                <h6 class="fw-bold mb-0 mb-md-1">Price:</h6>
                                                <label class="">€<?= $row['total_price']; ?></label>
                                            </div>
                                            <div class="col-md-3 mbrdr my-auto">
                                                <h6 class="fw-bold mb-0 mb-md-1">Order Placed at:</h6>
                                                <label class=""><?=  date('d-m-Y h:i A', strtotime($row['created_at'])); ?></label>
                                            </div>
                                            <div class="col-md-2 mbrdr col-6 my-auto">
                                                <h6 class="fw-bold mb-0 mb-md-1">Status:</h6>
                                                <?php if($row['status'] == '0') : ?>
                                                    <span class="badge bg-warning">In Progress</span>
                                                <?php elseif($row['status'] == '1') : ?>
                                                    <span class="badge bg-success">Completed</span>
                                                <?php elseif($row['status'] == '2') : ?>
                                                    <span class="badge bg-danger">Cancelled</span>
                                                <?php endif; ?>
                                            </div>
                                            <div class="col-md-1 mbrdr col-6 text-end my-auto">
                                                <h6 class="fw-bold mb-0 mb-md-1">Action</h6>
                                                <a href="vieworder.php?t=<?=$row['tracking_no'];?>" class="btn btn-funda bg-primary">View</a>    
                                            </div>
                                        </div>
                                    </div>

                                <?php
                            }
                        }
                        else
                        {
                            ?>
                            <tr>
                                <td colspan="4" class="text-center">
                                    You have not placed any orders!!
                                </td>
                            </tr>
                        <?php
                        }
                    }
                    else
                    {
                        die("Something Went Wrong");
                    }
                ?>
                     
            </div>
        </div>
    </div>
</div>

<?php
include('includes/footer.php');
?>
