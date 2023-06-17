<?php
include('authentication.php');
include('includes/header.php');
?>

<div class="container-fluid px-4">
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Total Revenue</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card  bg-primary text-white">
                                <div class="card-header">
                                    <h6>Total Payments Received: </h6>
                                </div>
                                <div class="card-body">
                                    <?php
                                        $total_amount_query = "SELECT SUM(total_price) as received_pay FROM orders WHERE payment_status='1' and status!='2' ";
                                        $total_amount_query_run = mysqli_query($con, $total_amount_query);

                                        if(mysqli_num_rows($total_amount_query_run) > 0)
                                        {
                                            $ttl_amt = mysqli_fetch_array($total_amount_query_run);
                                            $total_rec_amt = $ttl_amt['received_pay'];
                                        }
                                    ?>
                                    <h4>Rs. <?= $total_rec_amt ? :"0"; ?></h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card  bg-warning">
                                <div class="card-header">
                                    <h6>Payments Yet to receive (COD) : </h6>
                                </div>
                                <div class="card-body">
                                    <?php
                                        $total_pending_query = "SELECT SUM(total_price) as pending_pay FROM orders WHERE payment_status='0' and status!='2' ";
                                        $total_pending_query_run = mysqli_query($con, $total_pending_query);

                                        if(mysqli_num_rows($total_pending_query_run) > 0)
                                        {
                                            $pending_data = mysqli_fetch_array($total_pending_query_run);
                                            $pending_amount = $pending_data['pending_pay'];
                                        }

                                    ?>
                                    <h4>Rs. <?= $pending_amount ? :"0"; ?></h4>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-success text-white">
                                <div class="card-header">
                                    <h6>Total Earnings : </h6>
                                </div>
                                <div class="card-body">
                                    <?php
                                        $date = date('Y-m-d');
                                        $total_query = "SELECT SUM(total_price) as total_pay FROM orders WHERE status!='2'";
                                        $total_query_run = mysqli_query($con, $total_query);

                                        if(mysqli_num_rows($total_query_run) > 0)
                                        {
                                            $total_data = mysqli_fetch_array($total_query_run);
                                            $total_amount = $total_data['total_pay'];
                                        }

                                    ?>
                                    <h4>Rs. <?= $total_amount ? :"0"; ?></h4>

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
