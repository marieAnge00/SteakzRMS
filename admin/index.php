<?php
include('authentication.php');
include('includes/header.php');
?>

<div class="container-fluid px-4">
    <h3 class="mt-4">Food Ordering System</h3>
    <hr>
    <div class="order">
        <div class="btn btn-primary py-2 w-100 mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOrder" aria-expanded="false" aria-controls="collapseOrder">
            Orders Statistics <i class="fa fa-angle-down float-end fs-3"></i>
        </div>
        <div class="collapse mb-3 show" id="collapseOrder">
            <div class="card card-body">
                <div class="">
                    <h6>Today's Report</h6>
                    <?php $date = date('Y-m-d'); ?>
                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-warning text-white mb-4">
                                <?php 
                                $pending_order_query = "SELECT COUNT(id) as ordercount FROM orders WHERE status='0'  AND created_at like '$date%' ";
                                $pending_order_query_run = mysqli_query($con, $pending_order_query);

                                $pending_orders = mysqli_fetch_array($pending_order_query_run);
                                ?>
                                <div class="card-body">Pending Orders : <?= $pending_orders['ordercount'] ? :'0'; ?></div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="orders.php?status=pending&date=<?= $date ?>">View Details</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-success text-white mb-4">
                                <?php 
                                $completed_order_query = "SELECT COUNT(id) as ordercount FROM orders WHERE status='1'  AND created_at like '$date%' ";
                                $completed_order_query_run = mysqli_query($con, $completed_order_query);

                                $completed_orders = mysqli_fetch_array($completed_order_query_run);
                                ?>
                                <div class="card-body">Completed Orders : <?= $completed_orders['ordercount'] ? :'0'; ?></div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="orders.php?status=completed&date=<?= $date ?>">View Details</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-danger text-white mb-4">
                                <?php 
                                $cancelled_order_query = "SELECT COUNT(id) as ordercount FROM orders WHERE status='2'  AND created_at like '$date%' ";
                                $cancelled_order_query_run = mysqli_query($con, $cancelled_order_query);

                                $cancelled_orders = mysqli_fetch_array($cancelled_order_query_run);
                                ?>
                                <div class="card-body">Cancelled Orders : <?= $cancelled_orders['ordercount'] ? :'0'; ?></div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="orders.php?status=cancelled&date=<?= $date ?>">View Details</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="">
                    <h6>Overall Report</h6>
                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-warning text-white mb-4">
                                <?php 
                                $pending_order_query = "SELECT COUNT(id) as ordercount FROM orders WHERE status='0' ";
                                $pending_order_query_run = mysqli_query($con, $pending_order_query);

                                $pending_orders = mysqli_fetch_array($pending_order_query_run);
                                ?>
                                <div class="card-body">Pending Orders : <?= $pending_orders['ordercount'] ? :'0'; ?></div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-success text-white mb-4">
                                <?php 
                                $completed_order_query = "SELECT COUNT(id) as ordercount FROM orders WHERE status='1' ";
                                $completed_order_query_run = mysqli_query($con, $completed_order_query);

                                $completed_orders = mysqli_fetch_array($completed_order_query_run);
                                ?>
                                <div class="card-body">Completed Orders : <?= $completed_orders['ordercount'] ? :'0'; ?></div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-danger text-white mb-4">
                                <?php 
                                $cancelled_order_query = "SELECT COUNT(id) as ordercount FROM orders WHERE status='2' ";
                                $cancelled_order_query_run = mysqli_query($con, $cancelled_order_query);

                                $cancelled_orders = mysqli_fetch_array($cancelled_order_query_run);
                                ?>
                                <div class="card-body">Cancelled Orders : <?= $cancelled_orders['ordercount'] ? :'0'; ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="menu">
        <div class="btn btn-primary py-2 w-100 mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseMenu" aria-expanded="false" aria-controls="collapseMenu">
            Menu - Control Panel <i class="fa fa-angle-down float-end fs-3"></i>
        </div>
        <div class="collapse mb-3" id="collapseMenu">
            <div class="card card-body">
                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-secondary text-white mb-4">
                            <?php 
                            $category_query = "SELECT COUNT(id) as catecount FROM category ";
                            $category_query_run = mysqli_query($con, $category_query);

                            $category = mysqli_fetch_array($category_query_run);
                            ?>
                            <div class="card-body">Total Categories : <?= $category['catecount'] ? :'0'; ?></div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="category.php">View Details</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-success text-white mb-4">
                            <?php 
                            $product_query = "SELECT COUNT(id) as prodcount FROM products ";
                            $product_query_run = mysqli_query($con, $product_query);

                            $product = mysqli_fetch_array($product_query_run);
                            ?>
                            <div class="card-body">Total Items : <?= $product['prodcount'] ? :'0'; ?></div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="products.php">View Details</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-danger text-white mb-4">
                            <?php 
                            $hidden_product_query = "SELECT COUNT(id) as prodcount FROM products WHERE status='1' ";
                            $hidden_product_query_run = mysqli_query($con, $hidden_product_query);

                            $h_product = mysqli_fetch_array($hidden_product_query_run);
                            ?>
                            <div class="card-body">Hidden Items : <?= $h_product['prodcount'] ? :'0'; ?></div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="products.php">View Details</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-info text-white mb-4">
                            <?php 
                            $today_spcl_query = "SELECT COUNT(id) as prodcount FROM products WHERE today_special='1' ";
                            $today_spcl_query_run = mysqli_query($con, $today_spcl_query);

                            $today_spcl = mysqli_fetch_array($today_spcl_query_run);
                            ?>
                            <div class="card-body">Today's Special : <?= $today_spcl['prodcount'] ? :'0'; ?></div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="products.php">View Details</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="general">
        <div class="btn btn-primary py-2 w-100 mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
            General Statistics <i class="fa fa-angle-down float-end fs-3"></i>
        </div>
        <div class="collapse mb-3" id="collapseExample">
            <div class="card card-body">
                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-secondary text-white mb-4">
                            <?php 
                            $users_query = "SELECT COUNT(id) as usercount FROM users ";
                            $users_query_run = mysqli_query($con, $users_query);

                            $users = mysqli_fetch_array($users_query_run);
                            ?>
                            <div class="card-body">Total Registered Users : <?= $users['usercount'] ? :'0'; ?></div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="registered-users.php">View Details</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

    <div class="revenue">
        <div class="btn btn-primary py-2 w-100 mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseRevenue" aria-expanded="false" aria-controls="collapseRevenue">
            Revenue Report<i class="fa fa-angle-down float-end fs-3"></i>
        </div>
        <div class="collapse mb-3" id="collapseRevenue">
            <div class="card card-body">
                <div class="">
                    <h6>Today's Earnings</h6>
                    <div class="row">

                        <div class="col-xl-4 col-md-6">
                            <div class="card bg-info text-white mb-4">
                                <?php 
                                    $date = date('Y-m-d');
                                    $rec_query = "SELECT SUM(total_price) as received_pay FROM orders WHERE status != '2' AND payment_status='1' AND created_at like '$date%'";
                                    $rec_query_run = mysqli_query($con, $rec_query);

                                    $rec_data = mysqli_fetch_array($rec_query_run);
                                ?>
                                <div class="card-body">Payments Received : <?= $rec_data['received_pay'] ? :'0'; ?></div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="revenue.php">View Details</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6">
                            <div class="card bg-warning text-white mb-4">
                                <?php 
                                $date = date('Y-m-d');
                                $pending_query = "SELECT SUM(total_price) as pending_pay FROM orders WHERE status != '2' AND payment_status='0' AND created_at like '$date%'";
                                $pending_query_run = mysqli_query($con, $pending_query);

                                $pending_data = mysqli_fetch_array($pending_query_run);
                                ?>
                                <div class="card-body">Payments Yet to receive (COD) : <?= $pending_data['pending_pay'] ? :'0'; ?></div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="revenue.php">View Details</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6">
                            <div class="card bg-success text-white mb-4">
                                <?php 
                                $date = date('Y-m-d');
                                $total_query = "SELECT SUM(total_price) as total_pay FROM orders WHERE status != '2' AND created_at like '$date%'";
                                $total_query_run = mysqli_query($con, $total_query);

                                $total_amount = mysqli_fetch_array($total_query_run);
                                ?>
                                <div class="card-body">Total Earnings : <?= $total_amount['total_pay'] ? :'0'; ?></div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="revenue.php">View Details</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="">
                    <h6>Total Earnings</h6>
                    <div class="row">

                        <div class="col-xl-4 col-md-6">
                            <div class="card bg-info text-white mb-4">
                                <?php 
                                    $date = date('Y-m-d');
                                    $rec_query = "SELECT SUM(total_price) as received_pay FROM orders WHERE status != '2' AND payment_status='1' ";
                                    $rec_query_run = mysqli_query($con, $rec_query);

                                    $rec_data = mysqli_fetch_array($rec_query_run);
                                ?>
                                <div class="card-body">Payments Received : <?= $rec_data['received_pay'] ? :'0'; ?></div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="allrevenue.php">View Details</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6">
                            <div class="card bg-warning text-white mb-4">
                                <?php 
                                $date = date('Y-m-d');
                                $pending_query = "SELECT SUM(total_price) as pending_pay FROM orders WHERE status != '2' AND payment_status='0' ";
                                $pending_query_run = mysqli_query($con, $pending_query);

                                $pending_data = mysqli_fetch_array($pending_query_run);
                                ?>
                                <div class="card-body">Payments Yet to receive (COD) : <?= $pending_data['pending_pay'] ? :'0'; ?></div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="allrevenue.php">View Details</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6">
                            <div class="card bg-success text-white mb-4">
                                <?php 
                                $date = date('Y-m-d');
                                $total_query = "SELECT SUM(total_price) as total_pay FROM orders WHERE status != '2' ";
                                $total_query_run = mysqli_query($con, $total_query);

                                $total_amount = mysqli_fetch_array($total_query_run);
                                ?>
                                <div class="card-body">Total Earnings : <?= $total_amount['total_pay'] ? :'0'; ?></div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="allrevenue.php">View Details</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
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