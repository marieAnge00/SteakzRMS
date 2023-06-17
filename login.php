<?php
session_start();

if(isset($_SESSION['auth']))
{
    if(!isset($_SESSION['message'])){
        $_SESSION['message'] = "You are already logged In";
    }
    header("Location: index.php");
    exit(0);
}

include('includes/header.php');
?>

<div class="banner-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="banner-heading">Login</h3>
            </div>
        </div>
    </div>
</div>

<div class="section">
    <div class="container">
        <div class="row justify-content-around">
            <div class="col-md-5">
            
                <div class="card shadow-sm">
                    <div class="card-header bg-orange">
                        <h4 class="main-heading mb-0 text-white">Login</h4>
                    </div>
                    <div class="card-body">

                        <form action="logincode.php" method="POST">
                            <div class="form-group mb-3">
                                <label>Email Id</label>
                                <input type="email" name="email" required placeholder="Enter Email Address" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label>Password</label>
                                <input type="password" name="password" required placeholder="Enter Password" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <button type="submit" name="login_btn" class="btn btn-funda py-2 px-4 bg-orange">Login Now</button>
                            </div>
                        </form>

                    </div>
                </div>
                <div class="my-3 text-center">
                    <h5>Don't have an account? <a href="register.php" class="text-orange">Sign up</a></h5>

                </div>
            </div>
        </div>
    </div>
</div>

<?php
include('includes/footer.php');
?>