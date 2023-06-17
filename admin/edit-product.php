<?php
include('authentication.php');
include('includes/header.php');
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Edit Product</h1>
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-body">
                    <?php  
                        $id = $_GET['id'];
                        $query = "SELECT * FROM products WHERE id='$id' ";
                        $query_run = mysqli_query($con, $query);

                        if(mysqli_num_rows($query_run) > 0)
                        {
                            $data = mysqli_fetch_array($query_run);
                    ?>
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
                                                            <option value="<?= $row['id'] ?>" <?= $data['category_id']==$row['id']? "selected":""; ?>><?= $row['name'] ?></option>
                                                        <?php
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <input type="hidden" name="product_id" value="<?= $id ?>">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Name</label>
                                        <input type="text" required value="<?= $data['name']; ?>" class="form-control" name="name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Slug</label>
                                        <input type="text" required value="<?= $data['slug']; ?>" class="form-control" name="slug">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Select type</label>
                                        <select class="form-select" name="type" aria-label="Default select example">
                                            <option >Choose category</option>
                                            <option value="Veg" <?= $data['type']=='Veg'? "selected":""; ?> >Veg</option>
                                            <option value="Non-Veg" <?= $data['type']=='Non-Veg'? "selected":""; ?> >Non-Veg</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Price</label>
                                        <input type="text" required value="<?= $data['price']; ?>" class="form-control" name="price">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Description</label>
                                        <textarea id="summernote" class="summernote form-control" name="description"><?= $data['description']; ?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Add Product Image</label>
                                        <input type="file" class="form-control" name="image">
                                        <div class="mt-3">
                                            <label class="">Current image</label>
                                            <input type="hidden" name="image_old" value="<?= $data['image']; ?>">
                                            <img src="../uploads/<?= $data['image']; ?>" width="70px" height="70px" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Show/Hide</label> <br>
                                        <label class="switch">
                                            <input type="checkbox" <?php echo $data['status'] == '0'?'':'checked'; ?>  name="visibility">
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
                                            <input type="checkbox" <?php echo $data['trending'] == '1'?'':'checked'; ?>  name="trending">
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
                                            <input type="checkbox" <?php echo $data['today_special'] == '1'?'':'checked'; ?>  name="today_special">
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
                                            <input type="checkbox" <?php echo $data['availability_status'] == '1'?'checked':''; ?>  name="availability_status">
                                            <span class="slider round"></span>
                                        </label>
                                        <br>
                                        <small class="help-text">Green=Available, Red=Not Available</small>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mt-4">
                                        <button type="submit" name="update_product_btn" class="btn btn-primary btn-block float-right">Update Product</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <?php  
                        }
                        else
                        {
                            echo "The requested id was not found";
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

