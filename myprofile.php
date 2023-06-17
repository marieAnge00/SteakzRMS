<?php
    include('functions/authentication.php');
    include('includes/header.php');
?>

<div class="banner-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="banner-heading">Profile</h3>
            </div>
        </div>
    </div>
</div>

<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <h4 class="main-heading">My <span class="text-orange">Profile</span></h4>
                <div class="underline mb-4"></div>

                <?php 
                    $user_id = $_SESSION['auth_user']['user_id'];
                    $user_query = "SELECT * FROM users WHERE id='$user_id' ";
                    $user_query_run = mysqli_query($con, $user_query);

                    if($user_query_run)
                    {
                        $user = mysqli_fetch_array($user_query_run);
                        
                        ?>
                            <div class="">
                                <form action="allcode.php" method="POST">
                                    <div class="row">
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
                                    </div>
                                    <div class="text-end">
                                        <button class="btn btn-funda px-4 py-2 btn-primary" name="update_user_details">Update details</button>
                                    </div>
                                </form>
                            </div>
                        <?php
                    }
                ?>
            </div>
        </div>
    </div>
</div>

<?php
include('includes/footer.php');
?>
