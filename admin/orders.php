<?php
include('authentication.php');
include('includes/header.php');
?>

<div class="container-fluid px-4">
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Orders</h4>
                </div>
                <div class="card-body">
                    <form action="" method="GET">
                    <div class="row">
                            <div class="col-md-4">
                            </div>
                            <div class="col-md-3">
                                <label for="">Status</label>
                                <select class="form-select" name="status" aria-label="Default select example">
                                    <option value="" selected>Select status</option>
                                    <option selected <?php if(isset($_GET['status'])) { echo $_GET['status'] == 'pending'?'selected':''; } ?> value="pending">Pending</option>
                                    <option <?php if(isset($_GET['status'])) { echo $_GET['status'] == 'completed'?'selected':''; } ?> value="completed">Completed</option>
                                    <option <?php if(isset($_GET['status'])) { echo $_GET['status'] == 'cancelled'?'selected':''; } ?> value="cancelled">Cancelled</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="">Date</label>
                                <div class="">
                                    <input type="date" name="date" class="form-control" value="<?= isset($_GET['date']) ? $_GET['date'] : date('Y-m-d'); ?>">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <br>
                                <button type="submit" class="btn btn-primary w-100">
                                    Filter <i class="fa fa-filter"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <hr>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="myTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tracking No</th>
                                    <th>Customer Name</th>
                                    <th>Price</th>
                                    <th>Order placed at</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="ordertable">
                                <?php
                                // Order Status - 0=Pending, 1=completed , 2=Cancelled
                                $status = '0';
                                $date = date('Y-m-d');
                                if(isset($_GET['status']))

                                {
                                    if($_GET['status'] == 'pending')
                                    {
                                        $status = '0';
                                    }
                                    else if($_GET['status'] == 'completed')
                                    {
                                        $status = '1';
                                    }
                                    else if($_GET['status'] == 'cancelled')
                                    {
                                        $status = '2';
                                    }
                                }

                                if(isset($_GET['date']))
                                {
                                    $date = $_GET['date'];
                                }
                                
                                $order_query = "SELECT * FROM orders WHERE status='$status' AND created_at like '$date%' ";
                                $order_query_run = mysqli_query($con, $order_query);

                                $id = 1;

                                if(mysqli_num_rows($order_query_run) > 0)
                                {
                                    foreach($order_query_run as $row)
                                    {
                                        ?>
                                        <tr id="data">
                                            <td><?= $id++; ?></td>
                                            <td><?= $row['tracking_no']; ?></td>
                                            <td><?= $row['fname'].' '.$row['lname']; ?></td>
                                            <td><?= $row['total_price']; ?></td>
                                            <td><?= date('d-m-Y h:i A', strtotime($row['created_at'])); ?></td>
                                            <td>
                                                <a href="order-view.php?tracking_no=<?= $row['tracking_no']; ?>" class="btn btn-primary">View</a>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                }
                                else
                                {
                                ?>
                                    <tr class="text-center">
                                        <td colspan="6">No Orders for the above selected filter</td>
                                    </tr>
                                <?php
                                }
                                ?>
                                
                            </tbody>
                        </table>
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
