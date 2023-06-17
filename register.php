<?php
session_start();

if(isset($_SESSION['auth']))
{
    $_SESSION['message'] = "You are already logged In";
    header("Location: index.php");
    exit(0);
}

include('includes/header.php');
?>

<div class="banner-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="banner-heading">Register</h3>
            </div>
        </div>
    </div>
</div>

<div class="section">
    <div class="container">
        <div class="row justify-content-around">
            <div class="col-md-8">
            
                <div class="card shadow-sm">
                    <div class="card-header bg-orange">
                        <h4 class="main-heading mb-0 text-white">Register</h4>
                    </div>

                    <div class="card-body">
                        <form action="registercode.php" method="POST">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label>First Name</label>
                                        <input type="text" name="fname" required placeholder="Enter First Name" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label>Last Name</label>
                                        <input type="text" name="lname" required placeholder="Enter Last Name" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label>Email Id</label>
                                        <input type="email" name="email" required placeholder="Enter Email Address" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label>Phone Number</label>
                                        <input type="text" name="phone" onblur="PhoneNumvalidate()" maxlength="10" required placeholder="Enter Phone Number" class="form-control phone">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label>Password</label>
                                        <input type="password" name="password" required placeholder="Enter Password" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label>Confirm Password</label>
                                        <input type="password" name="cpassword" required placeholder="Enter Confirm Password" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group mb-3 text-center">
                                    <button type="submit" name="register_btn" class="btn btn-funda py-2 px-4 bg-orange">Register Now</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
                <div class="my-3 text-center">
                    <h5>Already have an account? 
                        <a href="#" data-bs-toggle="offcanvas" data-bs-target="#offcanvasLogin" class="text-orange">
                            Sign in
                        </a>
                    </h5>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include('includes/footer.php');
?>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
    
  function PhoneNumvalidate()
  {
    var filter = /^[0-9][0-9]{9}$/; //PATTERN FOR MOBILE NUMBER
    
    var a = $(".phone").val();     
    if (!(filter.test(a))) {
        swal("","Enter valid mobile number","warning");
        $(".phone").val('');
    }
  }

</script>
