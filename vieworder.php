<?php
    include('functions/authentication.php');
    include('includes/header.php');
    if(!isset($_GET['t']))
    {
        $_SESSION['message'] = "Something Went Wrong";
        header('Location: myorders.php');
        exit(0);
    }
    elseif(isset($_GET['t']))
    {
        $user_id = $_SESSION['auth_user']['user_id'];
        $tracking_no = mysqli_real_escape_string($con,$_GET['t']);

        // Check tracking number is valid and belongs to the logged in user
        $order_query = "SELECT * FROM orders WHERE tracking_no='$tracking_no' AND user_id='$user_id' ";
        $order_query_run = mysqli_query($con,$order_query);

        if($order_query_run)
        {
            if(!mysqli_num_rows($order_query_run) > 0)
            {
                $_SESSION['message'] = "Invalid Tracking Number";
                header('Location: myorders.php');
                exit(0);
            }
            else
            {
                $data = mysqli_fetch_array($order_query_run);
            }
        }
    }
?>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="allcode.php" method="POST">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Cancel Order</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong><i class="fa fa-warning"></i></strong> You are Cancelling your order.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                        <input type="hidden" name="tracking_no" value="<?= $tracking_no ?>">
                        <h6 class="mt-3">Cancel Reason <span class="text-danger">*</span> </h6>
                        <textarea rows="3" required class="form-control mb-2" name="cancel_reason"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button name="cancel_order_btn" class="btn btn-danger float-end">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="banner-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="banner-heading">Orders Details</h3>
            </div>
        </div>
    </div>
</div>

<div class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card mb-4">
                    <div class="card-header">
                        <h4 class="fw-bold m-fs16">
                            User  <span class="text-orange">Delivery Details</span>
                            <a href="myorders.php" class="btn btn-primary btn-sm float-end">
                                <i class="fa fa-reply"></i> Back
                            </a>
                        </h4>
                        <div class="underline mb-0"></div>
                    </div>
                    <div class="card-body">
                        <div class="account-area">
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label class="fw-bold">First Name</label>
                                    <div class="border p-1 px-2">
                                        <label class=""><?= $data['fname'] ?></lab>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="fw-bold">Last Name</label>
                                    <div class="border p-1 px-2">
                                        <label class=""><?= $data['lname'] ?></lab>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="fw-bold">Contact Number</label>
                                    <div class="border p-1 px-2">
                                        <label class=""><?= $data['phone'] ?></lab>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
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
                    </div>
                </div>
            </div>

            <div class="col-md-12">

                <div class="card">
                    <div class="card-header">
                        <h4 class="fw-bold m-fs16">
                            My <span class="text-orange">Order Details</span>
                            <a href="myorders.php" class="btn btn-primary btn-sm float-end">
                                <i class="fa fa-reply"></i> Back
                            </a>
                        </h4>
                        <div class="underline mb-0"></div>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <h6>Tracking Number : <?= $data['tracking_no']; ?></h6>
                            </div>
                            <div class="col-md-6 mb-2">
                                <h6>Order Status : 
                                    <?php if($data['status'] == '0') : ?>
                                        <span class="badge bg-warning">In Progress</span>
                                    <?php elseif($data['status'] == '1') : ?>
                                        <span class="badge bg-success">Completed</span>
                                    <?php elseif($data['status'] == '2') : ?>
                                        <span class="badge bg-danger">Cancelled</span>
                                    <?php endif; ?>
                                </h6>
                            </div>
                            <div class="col-md-6 mb-2">
                                <h6>Payment Mode : <?= $data['payment_mode']; ?></h6>
                            </div>
                            <div class="col-md-6 mb-2">
                                <h6>Payment Status : <?= $data['payment_status'] =='0'?'Pending':'Paid'; ?></h6>
                            </div>
                            <div class="col-md-6 mb-2">
                                <h6>Order placed at : <?= date('d-m-Y h:i A', strtotime($data['created_at'])); ?></h6>
                            </div>
                            <div class="col-md-6 mb-2">
                                <?php if($data['cancel_reason'] != '') : ?>
                                    <h6>Cancel Reason :</h6>
                                    <div class="border p-2 shadow-sm">
                                        <?= $data['cancel_reason']; ?>
                                    </div>
                                <?php endif; ?>
                                <?php if($data['status'] == '0') : ?>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-funda btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        <i class="fa fa-close"></i> Cancel Order
                                    </button>
                                <?php endif; ?>
                            </div>
                        </div>
                        <hr>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th colspan="2">Products</th>
                                        <th>Price</th>
                                        <th>QTY</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $orderview_query = "SELECT o.id as order_id, o.user_id,o.total_price, oi.order_id, oi.prod_id, oi.prod_qty, oi.prod_price, p.id as pid, p.name,p.image 
                                        FROM orders o, order_items oi, products p WHERE o.user_id='$user_id' AND p.id=oi.prod_id AND oi.order_id=o.id AND o.tracking_no='$tracking_no' ";
                                        $orderview_query_run = mysqli_query($con, $orderview_query);

                                        if($orderview_query_run)
                                        {
                                            if(mysqli_num_rows($orderview_query_run) > 0)
                                            {
                                                foreach($orderview_query_run as $item)
                                                {
                                                    ?>
                                                        <tr class="align-middle">
                                                            <td>
                                                                <img src="uploads/<?= $item['image']; ?>" class="checkout-img-tag" alt="item image">
                                                            </td>
                                                            <td><?= $item['name']; ?></td>
                                                            <td><?= $item['prod_price']; ?></td>
                                                            <td><?= $item['prod_qty']; ?></td>
                                                            <td><?= $item['prod_price'] * $item['prod_qty']; ?></td>
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
                        </div>

                        <div class="text-end">
                            <h4 class="">Total price: <?= $item['total_price']; ?></h4>
                            <small class="text-muted">( Inclusive of all taxes )</small>
                        </div>
                        
                                
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<?php
include('includes/footer.php');
?>
