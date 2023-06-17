<?php
include('authentication.php');
include('includes/header.php');
    if(!isset($_GET['tracking_no']))
    {
        ?>
            <h4>Something Went Wrong </h4>
        <?php
    }
    elseif(isset($_GET['tracking_no']))
    {
        $tracking_no = mysqli_real_escape_string($con,$_GET['tracking_no']);

        // Check tracking number is valid
        $order_query = "SELECT * FROM orders WHERE tracking_no='$tracking_no' ";
        $order_query_run = mysqli_query($con,$order_query);

        if($order_query_run)
        {
            if(!mysqli_num_rows($order_query_run) > 0)
            {
                ?>
                    <h4>Something Went Wrong </h4>
                <?php
            }
            else
            {
                $data = mysqli_fetch_array($order_query_run);
            }
        }
    }
?>


<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="">
                    <h4 class="heading">Order details
                        <a href="orders.php" class="btn btn-primary float-end mb-2">
                            <i class="fa fa-reply"></i> Back
                        </a>
                    </h4>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card card-body">
                    <div class="row">
                        <div class="col-md-7">
                            <h5 class="heading">Delivery details</h5>
                            <hr>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="fw-bold">First Name</label>
                                    <div class="border p-1 px-2">
                                        <label class=""><?= $data['fname'] ?></lab>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="fw-bold">Last Name</label>
                                    <div class="border p-1 px-2">
                                        <label class=""><?= $data['lname'] ?></lab>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="fw-bold">Contact Number</label>
                                    <div class="border p-1 px-2">
                                        <label class=""><?= $data['phone'] ?></lab>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="fw-bold">Pin Code</label>
                                    <div class="border p-1 px-2">
                                        <label class=""><?= $data['pincode'] ?></lab>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="fw-bold">Delivery Address</label>
                                    <div class="border p-1 px-2">
                                        <label class=""><?= $data['address'] ?></lab>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="fw-bold">Custom Message (optional)</label>
                                    <div class="border p-1 px-2">
                                        <label class=""><?= $data['user_message'] ?></lab>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-md-5">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $orderview_query = "SELECT o.id as order_id, o.user_id,o.total_price, oi.order_id, oi.prod_id, oi.prod_qty, oi.prod_price, p.id as pid, p.name,p.image 
                                        FROM orders o, order_items oi, products p WHERE p.id=oi.prod_id AND oi.order_id=o.id AND o.tracking_no='$tracking_no' ";
                                        $orderview_query_run = mysqli_query($con, $orderview_query);

                                        if($orderview_query_run)
                                        {
                                            if(mysqli_num_rows($orderview_query_run) > 0)
                                            {
                                                foreach($orderview_query_run as $item)
                                                {
                                                    ?>
                                                        <tr>
                                                            <td>
                                                                <img src="../uploads/<?= $item['image']; ?>" height="80px" width="80px" alt="item image">
                                                            </td>
                                                            <td><?= $item['name']; ?></td>
                                                            <td><?= $item['prod_price']; ?></td>
                                                            <td><?= $item['prod_qty']; ?></td>
                                                        </tr>
                                                    <?php
                                                }
                                            }
                                            else
                                            {
                                                die("Something Went Wrong");
                                            }
                                        }
                                        else
                                        {
                                            die("Something Went Wrong");
                                        }
                                    ?>
                                </tbody>
                            </table>
                            <div class="text-end">
                                <h4 class="">Total price: <?= $item['total_price']; ?></h4>
                            </div>
                            <div class="mt-3">
                                <h6>Tracking Number : <?= $data['tracking_no']; ?></h6>
                                <h6>Order Status : 
                                    <?php 
                                        if($data['status'] == '0')
                                        {
                                            ?>
                                                <span class="badge bg-warning">In Progress</span>
                                            <?php
                                        }
                                        else if($data['status'] == '1')
                                        {
                                            ?>
                                                <span class="badge bg-success">Completed</span>
                                            <?php
                                            
                                        }
                                        else if($data['status'] == '2')
                                        {
                                            ?>
                                                <span class="badge bg-danger mb-2">Cancelled</span>
                                                <br>
                                                Cancel Reason :
                                                <div class="border p-2 bg-light mt-1">
                                                    <?= $data['cancel_reason']; ?>
                                                </div>
                                            <?php
                                        }

                                    ?>    
                                </h6>

                                <h6>Payment Mode : <?= $data['payment_mode']; ?></h6>
                                <h6>Payment Status : <?= $data['payment_status'] =='0'?'Pending':'Paid'; ?></h6>
                                <h6>Order placed at : <?= date('d-m-Y h:i A', strtotime($data['created_at'])); ?></h6>
                                        
                                <hr>
                                <?php if($data['status'] != '2'): ?>
                                <div class="p-2">
                                    <h6 for="">Update Order Status</h6>
                                    <form action="code.php" method="POST">
                                        <input type="hidden" name="tracking_no" value="<?= $data['tracking_no']; ?>">
                                        <select class="form-select" name="order_status" aria-label="Default select example">
                                            <option value="" selected>Select status</option>
                                            <option <?= $data['status'] == '0'?'selected':''; ?> value="0">Pending</option>
                                            <option <?= $data['status'] == '1'?'selected':''; ?> value="1">Completed</option>
                                            <option <?= $data['status'] == '2'?'selected':''; ?> value="2">Cancelled</option>
                                        </select>
                                        <h6 class="mt-3">Cancel Reason</h6>
                                        <textarea rows="3" class="form-control mb-2" name="cancel_reason"></textarea>
                                        <button name="update_order_btn" class="btn btn-primary float-end mt-3">Update</button>
                                    </form>
                                </div>
                                <?php endif; ?>

                            </div>
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include('includes/footer.php');
include('includes/scripts.php');

?>

