<?php
include('authentication.php');
include('includes/header.php');
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Add Category</h1>
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-body">
                    <form action="code.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
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
                        
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Description</label>
                                    <textarea id="summernote" class="summernote form-control" name="description"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Add Category Image</label>
                                    <input type="file" required class="form-control" name="image">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Show/Hide</label> <br>
                                    <label class="switch">
                                        <input type="checkbox" name="visibility">
                                        <span class="slider round"></span>
                                    </label>
                                    <small class="help-text">Green=Shown, Red=Hidden</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Trending</label> <br>
                                    <label class="switch">
                                        <input type="checkbox" name="trending">
                                        <span class="slider round"></span>
                                    </label>
                                    <small class="help-text">Green=Trending, Red=Default</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mt-4">
                                    <button type="submit" name="add_category_btn" class="btn btn-primary btn-block float-right">Add Category</button>
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

