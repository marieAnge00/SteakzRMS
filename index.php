<?php
session_start();
include('includes/header.php');
include('includes/slider.php');

?>


<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <h4 class="main-heading">Todays <span class="text-orange">Special</span></h4>
                <div class="underline"></div>

                <div class="row">
                    <?php 
                        $tspecial_query = "SELECT * FROM products WHERE today_special='1' AND status='0'";
                        $tspecial_query_run = mysqli_query($con, $tspecial_query);

                        if($tspecial_query_run)
                        {
                            if(mysqli_num_rows($tspecial_query_run) > 0)
                            {
                                foreach($tspecial_query_run as $item)
                                {
                                    ?>
                                        <div class="col-md-3 product_data">
                                            <div class="box-card-one">
                                                <div class="box-card-body">
                                                    <div class="prod_image img-box">
                                                        <img src="uploads/<?= $item['image']; ?>" alt="item image">
                                                    </div>
                                                    <div class="box-card-content">

                                                        <h3 class="box-card-title"><?= $item['name']; ?></h3>
                                                        <h4 class="box-card-price">
                                                            € : <?= $item['price']; ?>
                                                            <span class="veg-non-veg-tag">
                                                                <i class="fa fa-circle <?= $item['type'] == 'Veg' ? 'veg-item':'non-veg-item'; ?>"></i>
                                                            </span>
                                                        </h4>

                                                        <div class="divider"></div>

                                                        <div class="row">
                                                            <div class="col-md-6 col-6">
                                                                <div>
                                                                    <input type="hidden" class="prod_id" value="<?= $item['id']; ?>">
                                                                    <div class="input-group text-center">
                                                                        <button class="input-group-text decrement-btn">-</button>
                                                                        <input type="text" name="quantity" disabled class="form-control bg-white qty-input text-center" value="1" >
                                                                        <button class="input-group-text increment-btn">+</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-6">
                                                                <div>
                                                                    <?php if($item['availability_status'] == '0') : ?>
                                                                        <button class="btn btn-funda bg-orange w-100 addToCartBtn"> <i class="fa fa-shopping-cart"></i> Add</button>
                                                                    <?php else : ?>
                                                                        <button class="btn btn-funda bg-danger w-100 disabled"> Unavailable</button>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                }
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('pages/about-us.php'); ?>

<div class="section bg-white">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <h4 class="main-heading">Our <span class="text-orange">Trending</span></h4>
                <div class="underline"></div>

                <div class="row owl-carousel owl-theme trend-foods">
                    <?php 
                        $trending_query = "SELECT * FROM products WHERE trending='1' AND status='0'";
                        $trending_query_run = mysqli_query($con, $trending_query);

                        if($trending_query_run)
                        {
                            if(mysqli_num_rows($trending_query_run) > 0)
                            {
                                foreach($trending_query_run as $item)
                                {
                                    ?>
                                        <div class="item">
                                            <div class="product_data">
                                                <div class="box-card-one">
                                                    <div class="box-card-body">
                                                        
                                                        <div class="prod_image img-box">
                                                            <img src="uploads/<?= $item['image']; ?>" class="w-100" alt="item image">
                                                        </div>
                                                        <div class="box-card-content">
                                                            <h3 class="box-card-title"><?= $item['name']; ?></h3>
                                                            <h4 class="box-card-price">
                                                                € : <?= $item['price']; ?>

                                                                <span class="veg-non-veg-tag">
                                                                    <i class="fa fa-circle <?= $item['type'] == 'Veg' ? 'veg-item':'non-veg-item'; ?>"></i>
                                                                </span>

                                                            </h4>

                                                            <div class="divider"></div>

                                                            <div class="row">
                                                                <div class="col-md-6 col-6">
                                                                    <div>
                                                                        <input type="hidden" class="prod_id" value="<?= $item['id']; ?>">
                                                                        <div class="input-group text-center">
                                                                            <button class="input-group-text decrement-btn">-</button>
                                                                            <input type="text" name="quantity" disabled class="form-control bg-white qty-input text-center" value="1" >
                                                                            <button class="input-group-text increment-btn">+</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 col-6">
                                                                    <div>
                                                                        <?php if($item['availability_status'] == '0') : ?>
                                                                            <button class="btn btn-funda bg-orange w-100 addToCartBtn"> <i class="fa fa-shopping-cart"></i> Add</button>
                                                                        <?php else : ?>
                                                                            <button class="btn btn-funda bg-danger w-100 disabled">Unavailable</button>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                }
                            }
                        }
                    ?>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="contact-banner">
    <div class="section contact-banner-overlay">
        <div class="container">
            <div class="row justify-content-end">
                <div class="col-md-9">
                    <h4 class="text-white main-heading">Contact Us</h4>
                    <div class="underline bg-white"></div>
                    <div class="contact-content">
                    <form action="" method="POST">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="">Full Name</label>
                                    <input type="text" required class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="">Email Address</label>
                                    <input type="text" required class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="">Subject</label>
                                    <input type="text" required class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="">Phone</label>
                                    <input type="text" required class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="">Message</label>
                                    <textarea name="" required class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button class="btn btn-funda bg-orange py-2 px-4">Send Message</button>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include('includes/footer.php');
?>
