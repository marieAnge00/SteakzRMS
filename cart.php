<?php
    include('functions/authentication.php');
    include('includes/header.php');
?>

<div class="banner-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="banner-heading">My Cart</h3>
            </div>
        </div>
    </div>
</div>

<div class="section">
    <div class="container" id="usercart">
        <div class="row" id="cart">
            <div class="col-md-12">

                <?php 

                $user_id = $_SESSION['auth_user']['user_id'];
                $cart_query = "SELECT c.id as cid, c.product_id, c.product_qty, c.user_id , p.id as pid, p.name, p.price,p.image, p.availability_status, p.status FROM carts c, products p WHERE (c.user_id='$user_id' AND p.id=c.product_id) ORDER BY cid DESC ";
                $cart_query_run = mysqli_query($con, $cart_query);

                if($cart_query_run)
                {
                    if(mysqli_num_rows($cart_query_run) > 0)
                    {
                    ?>
                        <h4 class="main-heading">My <span class="text-orange">Cart</span></h4>
                        <div class="underline mb-4"></div>

                        <div class="d-none d-sm-none d-md-block">
                            <div class="row">
                                <div class="col-md-2 col-12 my-auto">
                                    <h6>Image</h6>
                                </div>
                                <div class="col-md-4 col-12 my-auto">
                                    <h6>Name</h6>
                                </div>
                                <div class="col-md-2 col-12 my-auto">
                                    <h6>Price</h6>
                                </div>
                                <div class="col-md-2 col-12 my-auto">
                                    <h6>Quantity</h6>
                                </div>
                                <div class="col-md-2 col-12 my-auto">
                                </div>
                            </div>
                        </div>

                        <?php 
                            $total_price = 0;

                            foreach($cart_query_run as $item)
                            {
                                $total_price += $item['price'] * $item['product_qty'];
                                ?>
                                    <div class="cart-page-section">
                                        <div class="row product_data">
                                            <div class="col-md-2 col-4 my-auto">
                                                <img src="uploads/<?= $item['image']; ?>" class="cart-image" alt="item image">
                                            </div>
                                            <div class="col-md-4 col-8 my-auto">
                                                <label class="cart-list-heading mt-0 mt-md-0"><?= $item['name']; ?></label>
                                            </div>
                                            <div class="col-md-2 col-3 my-auto">
                                                <label class="mt-2 mt-md-0">€<?= $item['price']; ?></label>
                                            </div>
                                            <div class="col-md-2 col-5 my-auto">
                                                <input type="hidden" class="cart_id" value="<?= $item['cid']; ?>">
                                                <input type="hidden" class="prod_id" value="<?= $item['pid']; ?>">
                                                <div class="cart-btn-area">
                                                    <?php 
                                                        if($item['availability_status'] == '0' && $item['status'] == '0')
                                                        {
                                                            ?>
                                                                <div class="input-group mt-2 mt-md-0 text-center">
                                                                    <button class="input-group-text changeQuantity decrement-btn">-</button>
                                                                    <input type="text" name="quantity" disabled class="form-control bg-white qty-input text-center" value="<?= $item['product_qty'] ?>" >
                                                                    <button class="input-group-text changeQuantity increment-btn">+</button>
                                                                </div>
                                                            <?php
                                                        }
                                                        else
                                                        {
                                                            ?>
                                                                <div class="mt-2 mt-md-0">
                                                                    <button class="btn btn-sm btn-secondary disabled"> <i class="fa fa-close d-none d-md-inline"></i> Unavailable</button>
                                                                </div>
                                                            <?php
                                                        }
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-2 col-4 my-auto">
                                                <button class="btn btn-funda mt-2 mt-md-0 bg-danger removeFromCartBtn"> <i class="fa fa-trash d-none d-md-inline"></i> Remove</button>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                            }
                                
                        ?>
                        <hr>
                        <div class="mx-3">
                            <div class="text-end">
                                <h5 class="mb-0">Total Price : <?= $total_price ?></h5>
                                <small class="text-muted">( Inclusive of all taxes )</small>
                                <div class="mt-2">
                                    <a href="checkout.php" class="btn btn-outline-primary">Checkout <i class="fa fa-shopping-cart"></i></a>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    else
                    {
                        ?>
                         <div class="card card-body shadow-sm text-center py-5">
                            <h4 class="main-heading">Your cart is empty</h4>
                        </div>
                        <?php
                    }
                }
                else
                {
                    die("Something Went Wrong");
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?php
include('includes/footer.php');
?>
