<?php
session_start();
include('includes/header.php');

?>

<div class="banner-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="banner-heading">Menu Items</h3>
            </div>
        </div>
    </div>
</div>


<div class="section">
    <div class="container">
        <div class="row">

                <?php
                    if(isset($_GET['menu-category']))
                    {
                        $category_slug = mysqli_real_escape_string($con, $_GET['menu-category']);

                        // Check if category exists 
                        $chk_category_exists_query = "SELECT * FROM category WHERE slug='$category_slug' AND status='0' ";
                        $chk_category_exists_query_run = mysqli_query($con,$chk_category_exists_query);

                        if(mysqli_num_rows($chk_category_exists_query_run) > 0)
                        {
                            $category = mysqli_fetch_array($chk_category_exists_query_run);
                            $category_id = $category['id'];
                        ?>
                        <div class="col-md-12">
                            <h4 class="main-heading">Menu Items <span class="text-orange">for <?= $category['name']; ?></span></h4>
                            <div class="underline mb-4"></div>
                        </div>
                
                        <div class="col-md-8">
                            <div class="row">
                                <?php 
                                $menu_list_query = "SELECT * FROM products WHERE category_id='$category_id' AND status='0' ";
                                $menu_list_query_run = mysqli_query($con, $menu_list_query);

                                if($menu_list_query_run)
                                {
                                    if(mysqli_num_rows($menu_list_query_run) > 0)
                                    {
                                        foreach($menu_list_query_run as $item)
                                        {
                                            ?>
                                            <div class="col-md-12">
                                                <div class="box-items product_data">
                                                    <div class="row">
                                                        <div class="col-md-9 col-12 order-2 order-md-1">
                                                            <div class="box-item-content">
                                                                <div class="veg-non-veg-tag">
                                                                    <i class="fa fa-circle <?= $item['type'] == 'Veg' ? 'veg-item':'non-veg-item'; ?>"></i>
                                                                </div>
                                                                <h4 class="box-item-title"><?= $item['name']; ?></h4>
                                                                <h4 class="box-item-price">Rs <?= $item['price']; ?></h4>
                                                                <div class="box-item-description">
                                                                    <?= $item['description']; ?>
                                                                </div>
                                                                <div class="cart-btn-area">
                                                                    <div class="d-inline-block">
                                                                        <input type="hidden" class="prod_id" value="<?= $item['id']; ?>">
                                                                        <div class="input-group text-center">
                                                                            <button class="input-group-text decrement-btn">-</button>
                                                                            <input type="text" name="quantity" disabled class="form-control bg-white qty-input text-center" value="1" >
                                                                            <button class="input-group-text increment-btn">+</button>
                                                                        </div>
                                                                    </div>
                                                                    <div class="d-inline-block">
                                                                        <?php if($item['availability_status'] == '0') : ?>
                                                                            <button class="btn btn-funda bg-orange addToCartBtn"> <i class="fa fa-shopping-cart"></i> Add To Cart</button>
                                                                        <?php else : ?>
                                                                            <button class="btn btn-funda bg-danger disabled">Unavailable</button>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 col-12 order-1 order-md-2">
                                                            <div class="box-item-img">
                                                                <img src="uploads/<?= $item['image']; ?>" alt="item image">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        ?>
                                            <h4>Menu Items - No Items available for this category in the table</h4>
                                        <?php
                                    }
                                }
                                ?>
                                
                            </div> <!-- row end -->
                        </div><!-- col 8 end -->
                        <div class="col-md-4 ">
                            <div class="card custom-sticky-top p-4 shadow-sm">
                                <h4 class="main-heading">Call Us <span class="text-orange">any enquiry</span></h4>
                                <div class="underline my-3"></div>
                                <h4>+41 888 X5X5 555</h4>
                            </div>
                        </div>
                        <?php
                        }
                    else
                    {
                    ?>
                    <div class="col-md-12">
                        <div class="card card-body shadow-sm text-center py-5">
                            <h4 class="main-heading">Requested Menu Not Found</h4>
                        </div>
                    </div>
                    <?php
                    }
                   
                }
                else
                {
                    ?>
                    <div class="col-md-12">
                        <div class="card card-body shadow-sm text-center py-5">
                            <h4 class="main-heading">Requested Menu Not Found</h4>
                        </div>
                    </div>
                    <?php
                }
                ?>
        </div>
    </div>
</div>

<?php
include('includes/footer.php');
?>
