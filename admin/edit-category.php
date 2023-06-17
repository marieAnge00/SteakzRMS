<?php
include('authentication.php');
include('includes/header.php');
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Edit Category</h1>
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-body">
                    <?php  
                        $id = $_GET['id'];
                        $query = "SELECT * FROM category WHERE id='$id' ";
                        $query_run = mysqli_query($con, $query);

                        if(mysqli_num_rows($query_run) > 0)
                        {
                            $data = mysqli_fetch_array($query_run);
                    ?>
                            <form action="code.php" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <input type="hidden" name="category_id" value="<?= $data['id']; ?>">
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
                                
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Description</label>
                                            <textarea id="summernote" class="summernote form-control" required name="description"><?= $data['description']; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Add Category Image</label>
                                            <input type="file" class="form-control" name="image">
                                            <div class="mt-3">
                                                <label class="">Current image</label>
                                                <input type="hidden" name="image_old" value="<?= $data['image']; ?>">
                                                <img src="../uploads/<?= $data['image']; ?>" width="70px" height="70px" alt="">
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Show/Hide</label> <br>
                                            <label class="switch">
                                                <input type="checkbox" <?php echo $data['status'] == '0'?'':'checked'; ?> name="visibility">
                                                <span class="slider round"></span>
                                            </label>
                                            <small class="help-text">Green=Shown, Red=Hidden</small>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Trending</label> <br>
                                            <label class="switch">
                                                <input type="checkbox" <?php echo $data['trending'] == '0'?'checked':''; ?> name="trending">
                                                <span class="slider round"></span>
                                            </label>
                                            <small class="help-text">Green=Trending, Red=Default</small>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mt-4">
                                            <button type="submit" name="update_category_btn" class="btn btn-primary float-end">Update Category</button>
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

