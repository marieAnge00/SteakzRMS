<?php
include('authentication.php');
include('includes/header.php');
?>

<div class="container-fluid px-4">
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Today's Revenue</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card bg-primary text-white">
                                <div class="card-header">
                                    <h6>Payments Received: </h6>
                                </div>
                                <div class="card-body">
                                    <?php
                                        $date = date('Y-m-d');
                                        $rec_query = "SELECT SUM(total_price) as received_pay FROM orders WHERE status != '2' AND payment_status='1' AND created_at like '$date%'";
                                        $rec_query_run = mysqli_query($con, $rec_query);

                                        if(mysqli_num_rows($rec_query_run) > 0)
                                        {
                                            $rec_data = mysqli_fetch_array($rec_query_run);
                                            $received_amount = $rec_data['received_pay'];
                                        }
                                    ?>
                                    <h4>Rs. <?= $received_amount ? :"0"; ?></h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-warning">
                                <div class="card-header">
                                    <h6>Payments Yet to receive (COD) : </h6>
                                </div>
                                <div class="card-body">
                                    <?php
                                        $date = date('Y-m-d');
                                        $pending_query = "SELECT SUM(total_price) as pending_pay FROM orders WHERE status != '2' AND payment_status='0' AND created_at like '$date%'";
                                        $pending_query_run = mysqli_query($con, $pending_query);

                                        if(mysqli_num_rows($pending_query_run) > 0)
                                        {
                                            $pending_data = mysqli_fetch_array($pending_query_run);
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
                                        $total_query = "SELECT SUM(total_price) as total_pay FROM orders WHERE status != '2' AND created_at like '$date%'";
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
