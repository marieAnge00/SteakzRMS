<?php
session_start();
include('includes/header.php');

?>

<div class="banner-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="banner-heading">Menu Categories</h3>
            </div>
        </div>
    </div>
</div>

<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <h4 class="main-heading">Menu <span class="text-orange">List</span></h4>
                <div class="underline"></div>

                    <div class="row">
                        <?php 
                            $mcategory_query = "SELECT * FROM category WHERE status='0' ";
                            $mcategory_query_run = mysqli_query($con, $mcategory_query);

                            if($mcategory_query_run)
                            {
                                if(mysqli_num_rows($mcategory_query_run) > 0)
                                {
                                    foreach($mcategory_query_run as $item)
                                    {
                                        ?>
                                            <div class="col-md-3">
                                                <div class="box-card-one">
                                                    <div class="box-card-body">
                                                        <a href="menu-items.php?menu-category=<?= $item['slug']; ?>">
                                                            <div class="prod_image img-box">
                                                                <img src="uploads/<?= $item['image']; ?>" class="w-100" alt="item image">
                                                            </div>
                                                            <div class="box-card-content text-center">
                                                                <h3 class="box-card-title"><?= $item['name']; ?></h3>
                                                                <div>
                                                                    <button class="btn btn-funda bg-orange w-100">View</button>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                    }
                                }
                                else
                                {
                                    ?>
                                    <div class="col-md-12">
                                        <h4>Menu Category - No categories in the table</h4>
                                    </div>
                                    <?php
                                }
                            }
                        ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<?php
include('includes/footer.php');
?>
