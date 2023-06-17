<?php
include('authentication.php');
include('includes/header.php');
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Add Product</h1>
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-body">
                    <form action="code.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Select category</label>
                                    <select class="form-select" name="category_id" aria-label="Default select example">
                                        <option selected>Choose category</option>
                                        <?php
                                            $query = "SELECT * FROM category";
                                            $query_run = mysqli_query($con, $query);

                                            if(mysqli_num_rows($query_run) > 0)
                                            {
                                                foreach($query_run as $row)
                                                {
                                                    ?>
                                                        <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                                                    <?php
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" required class="form-control" name="name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Slug</label>
                                    <input type="text" required class="form-control" name="slug">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Select type</label>
                                    <select class="form-select" required name="type" aria-label="Default select example">
                                        <option selected>Choose category</option>
                                        <option value="Veg">Veg</option>
                                        <option value="Non-Veg">Non-Veg</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Price</label>
                                    <input type="text" required class="form-control" name="price">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Description</label>
                                    <textarea id="summernote" class="summernote form-control" name="description"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Add Product Image</label>
                                    <input type="file" required class="form-control" name="image">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">Show/Hide</label> <br>
                                    <label class="switch">
                                        <input type="checkbox" name="visibility">
                                        <span class="slider round"></span>
                                    </label>
                                    <br>
                                    <small class="help-text">Green=Shown, Red=Hidden</small>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">Trending</label> <br>
                                    <label class="switch">
                                        <input type="checkbox" name="trending">
                                        <span class="slider round"></span>
                                    </label>
                                    <br>
                                    <small class="help-text">Green=Trending, Red=Default</small>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">Today's Special</label> <br>
                                    <label class="switch">
                                        <input type="checkbox" name="today_special">
                                        <span class="slider round"></span>
                                    </label>
                                    <br>
                                    <small class="help-text">Green=Yes, Red=No</small>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">Availability Status</label> <br>
                                    <label class="switch">
                                        <input type="checkbox" name="availability_status">
                                        <span class="slider round"></span>
                                    </label><br>
                                    <small class="help-text">Green=Available, Red=Not Available</small>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mt-4">
                                    <button type="submit" name="add_product_btn" class="btn btn-primary btn-block float-right">Save Product</button>
                                </div>
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

<?php
include('includes/footer.php');
include('includes/scripts.php');
?>

