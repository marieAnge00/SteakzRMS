<?php
    include('functions/authentication.php');
    include('includes/header.php');
    
    $user_id = $_SESSION['auth_user']['user_id'];


    // To load user's data (Name, email, phone)
    $user_query = "SELECT * FROM users WHERE id='$user_id' LIMIT 1 ";
    $user_query_run = mysqli_query($con, $user_query);
    $userdata = mysqli_fetch_array($user_query_run);

    // To load the user cart
    $cart_query = "SELECT c.id as cid, c.product_id, c.product_qty, c.user_id , p.id as pid, p.name, p.price,p.image, p.availability_status, p.status FROM carts c, products p WHERE c.user_id='$user_id' AND p.id=c.product_id ";
    $cart_query_run = mysqli_query($con, $cart_query);

    if($cart_query_run)
    {
        // Check if user's cart is not empty
        if(mysqli_num_rows($cart_query_run) <= 0)
        {
            $_SESSION['message'] = "Your cart is empty";
            header('Location: menu-categories.php');       
            exit(0);
        }
        /*  Check if any item which was added to cart previously but now 
            that item is updated as currently unavailable. If any such item exists in 
            the user's cart, remove that item from user's cart   */
        else if(mysqli_num_rows($cart_query_run) > 0)
        {
            foreach($cart_query_run as $item)
            {
                if($item['availability_status'] != '0' || $item['status'] != '0')
                {
                    $cart_id = $item['cid'];
                    $remove_unavail_query = "DELETE FROM carts WHERE id='$cart_id' AND user_id='$user_id' ";
                    $remove_unavail_query_run = mysqli_query($con, $remove_unavail_query);
                }
            }
        }
    }
?>

<div class="banner-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="banner-heading">Checkout</h3>
            </div>
        </div>
    </div>
</div>

<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="carsd card-sbody">
                    <form action="functions/checkoutcode.php" method="POST">
                        <div class="row">
                            <div class="col-md-7 mt-3">
                                <h4 class="main-heading">Basic <span class="text-orange">Information</span></h4>
                                <hr>
                                <div class="row checkout-form">
                                    <div class="col-md-6 mt-3">
                                        <label for="">First Name</label>
                                        <input type="text" required class="form-control firstname" value="<?= $userdata['fname'] ?>" name="fname" placeholder="Enter First Name">
                                        <span id="fname_error" class="text-danger"></span>
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <label for="">Last Name</label>
                                        <input type="text" required class="form-control lastname" value="<?= $userdata['lname'] ?>" name="lname" placeholder="Enter Last Name">
                                        <span id="lname_error" class="text-danger"></span>
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <label for="">Phone Number</label>
                                        <input type="text" onblur="PhoneNumvalidate()" maxlength="10" value="<?= $userdata['phone'] ?>" required class="form-control phone" name="phone" placeholder="Enter Phone Number">
                                        <span id="phone_error" class="text-danger"></span>
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <label for="">Pin Code</label>
                                        <input type="text" onblur="pincodevalidate()" required maxlength="6" class="form-control pincode" name="pincode" placeholder="Enter Pin Code">
                                        <span id="pincode_error" class="text-danger"></span>
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <label for="">Full Address</label>
                                        <textarea name="address" class="form-control address" placeholder="Enter your full address" rows="3"></textarea>
                                        <span id="address_error" class="text-danger"></span>

                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <label for="">User Message (optional)</label>
                                        <textarea name="user_message" class="form-control user_message" placeholder="Enter your full address" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5 mt-3">
                                <h4 class="main-heading">Order  <span class="text-orange">Details</span></h4>
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
                                            $cart_query = "SELECT c.id as cid, c.product_id, c.product_qty, c.user_id , p.id as pid, p.name, p.price,p.image, p.availability_status, p.status FROM carts c, products p WHERE c.user_id='$user_id' AND p.id=c.product_id ";
                                            $cart_query_run = mysqli_query($con, $cart_query);

                                            if($cart_query_run)
                                            {
                                                if(mysqli_num_rows($cart_query_run) > 0)
                                                {
                                                    $total_price = 0;
                                                    foreach($cart_query_run as $item)
                                                    {
                                                        $total_price += $item['price'] * $item['product_qty'];
                                                        ?>
                                                            <tr class="align-middle">
                                                                <td>
                                                                    <img src="uploads/<?= $item['image']; ?>" class="checkout-img-tag" alt="item image">
                                                                </td>
                                                                <td>
                                                                    <label class="cart-list-heading"><?= $item['name']; ?></label>
                                                                </td>
                                                                <td>
                                                                    <label><?= $item['price']; ?></label>
                                                                </td>
                                                                <td>
                                                                    <label><?= $item['product_qty']; ?></label>
                                                                </td>
                                                                <td>
                                                                    <label><?= $item['price'] * $item['product_qty']; ?></label>
                                                                </td>
                                                            </tr>
                                                        <?php
                                                    }
                                                    ?>
                                                    
                                                    <?php
                                                }
                                                else
                                                {
                                                    header('Location: menu-categories.php');
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
                                <div class="checkout-details">
                                    <div class="row">
                                        <div class="col-md-6 col-7">
                                            <h5>Grand Total :</h5>
                                        </div>
                                        <div class="col-md-6 col-5">
                                            <h5 class="text-end"> € <?= $total_price; ?></h5>
                                        </div>
                                        <div class="col-md-12 col-12">
                                            <small class="text-muted float-end">( Inclusive of all taxes )</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <input type="hidden" name="payment_mode" value="COD">
                                    <button type="submit" class="btn btn-primary w-100 mb-2">Place Order | COD</button>
                                    
                                    <button type="button" class="btn btn-purple text-white w-100 mb-2 payRazorpayBtn">Pay with Razorpay</button>

                                    <div id="paypal-button-container"></div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


<?php
    include('includes/footer.php');
?>
<script src="assets/js/checkout.js"></script>

<script>
    function pincodevalidate()
    {
        var filter = /^[0-9][0-9]{5}$/; //6 Digit Pin code
        
        var a = $(".pincode").val();
        if (!(filter.test(a))) {
            swal("","Enter valid 6 digit pin code","warning");
            $(".pincode").val('');
        }
    }

    
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

<script src="https://www.paypal.com/sdk/js?client-id=AZs2Jlax_z6GXz7Xo8iCfBF2PwwbatjT0fG0M--HtqzLpL8UZfLx_zbIB8SupDvz_kH98zh5OwL6QV94"> </script>

<script>
    paypal.Buttons({
        onClick: function(data, actions) {
            // Data Validation
            if($.trim($('.firstname').val()).length == 0){
                error_fname = 'Please enter First Name';
                $('#fname_error').text(error_fname);
            }else{
                error_fname = '';
                $('#fname_error').text(error_fname);
            }

            if($.trim($('.lastname').val()).length == 0){
                error_lname = 'Please enter Last Name';
                $('#lname_error').text(error_lname);
            }else{
                error_lname = '';
                $('#lname_error').text(error_lname);
            }

            if($.trim($('.phone').val()).length == 0){
                error_phone = 'Please enter a valid phone number';
                $('#phone_error').text(error_phone);
            }else{
                error_phone = '';
                $('#phone_error').text(error_phone);
            }

            if($.trim($('.address').val()).length == 0){
                error_address = 'Please enter Address';
                $('#address_error').text(error_address);
            }else{
                error_address = '';
                $('#address_error').text(error_address);
            }
            
            if($.trim($('.pincode').val()).length == 0){
                error_zipcode = 'Please enter Pincode';
                $('#pincode_error').text(error_zipcode);
            }else{
                error_zipcode = '';
                $('#pincode_error').text(error_zipcode);
            }

            if(error_fname != '' || error_lname != '' || error_phone != '' || error_address != ''|| error_zipcode != '')
            {
                swal("Alert !","All fields are mandatory","warning");
                return false;
            }
            else
            {
                return true;
            }
        },
        createOrder: function(data, actions) {
            // This function sets up the details of the transaction, including the amount and line item details.
            return actions.order.create({
            purchase_units: [{
                amount: {
                    value: '<?= $total_price ?>'
                }
            }]
            });
        },
        onApprove: function(data, actions) {
            // This function captures the funds from the transaction.
            return actions.order.capture().then(function(details) {
            // This function shows a transaction success message to your buyer.
            //   alert('Transaction completed by ' + details.payer.name.given_name);

                var firstname = $('.firstname').val();
                var lastname = $('.lastname').val();
                var phone = $('.phone').val();
                var address = $('.address').val();
                var pincode = $('.pincode').val();
                var user_message = $('.user_message').val();

                $.ajax({
                    method: "POST",
                    url: "functions/handlecheckout.php",
                    data: {
                        'fname':firstname,
                        'lname':lastname,
                        'phone':phone,
                        'address':address,
                        'pincode':pincode,
                        'user_message':user_message,
                        'payment_mode':"Paid by Paypal",
                        'payment_id':details.id,
                        'scope': "placeorder"
                    },
                    success: function (response) {
                        var res= JSON.parse(response);
                        swal("",res.message,res.icon).then( (value) => {
                            if (value) {
                                window.location.href = "myorders.php"
                            }
                        });
                    }
                });
            });
        }
    }).render('#paypal-button-container');
    //This function displays Smart Payment Buttons on your web page.
</script>