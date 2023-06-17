<?php
include('authentication.php');
include('includes/header.php');
?>

<div class="container-fluid px-4">
    <div class="row mt-5">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Edit User Details
                        <a href="registered-users.php" class="btn btn-primary float-end mb-2">
                            <i class="fa fa-reply"></i> Back
                        </a>
                    </h4>
                </div>
                <div class="card-body">
                    <?php
                    if(isset($_GET['id']))
                    {
                        $userid = $_GET['id'];
                        $query = "SELECT * FROM users WHERE id='$userid' ";
                        $query_run = mysqli_query($con, $query);

                        if(mysqli_num_rows($query_run) > 0)
                        {
                            $user = mysqli_fetch_array($query_run);
                            ?>
                                <form action="code.php" method="POST">
                                    <div class="row">
                                        <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                                        <div class="col-md-6 mb-3">
                                            <label for="">First Name</label>
                                            <input type="text" name="fname" class="form-control" value="<?= $user['fname'] ?>">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="">Last Name</label>
                                            <input type="text" name="lname" class="form-control" value="<?= $user['lname'] ?>">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="">Email</label>
                                            <input type="text" readonly name="email" class="form-control" value="<?= $user['email'] ?>">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="">Contact Number</label>
                                            <input type="number" name="phone" class="form-control" value="<?= $user['phone'] ?>">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="mb-3">
                                                <label class="form-label">User Status</label> <br>
                                                <label class="switch">
                                                    <input type="checkbox" <?= $user['status'] ?'checked':'' ?>  name="status">
                                                    <span class="slider round"></span>
                                                </label>
                                                <br>
                                                <small class="help-text">Green=Active, Red=Banned</small>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <div class="mb-3">
                                                <label class="form-label">Role</label> <br>
                                                <select class="form-select" name="role_as" aria-label="Default select example">
                                                    <option <?= $user['role_as'] == '0'?'selected':''; ?> value="0">User</option>
                                                    <option <?= $user['role_as'] == '1'?'selected':''; ?> value="1">Admin</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-end">
                                        <button class="btn btn-primary" name="update_user_data">Update details</button>
                                    </div>
                                </form>
                            <?php
                        }
                        else
                        {
                            ?>
                                <h2>Invalid User ID</h2>
                            <?php
                        }
                    }
                    else
                    {
                        ?>
                            <h2>Something went wrong</h2>
                        <?php
                    }

                    ?>

                </div>
            </div>
        </div>

    </div>
</div>

<?php
include('includes/footer.php');
include('includes/scripts.php');
?>