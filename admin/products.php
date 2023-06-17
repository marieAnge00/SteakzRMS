<?php
include('authentication.php');
include('includes/header.php');
?>

<div class="container-fluid px-4">
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>All Category</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="myTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>Visibility</th>
                                    <th>Trending</th>
                                    <th>Today's Spcl</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * FROM products";
                                $query_run = mysqli_query($con, $query);

                                if(mysqli_num_rows($query_run) > 0)
                                {
                                    foreach($query_run as $row)
                                    {
                                        ?>
                                        <tr>
                                            <td><?= $row['id']; ?></td>
                                            <td><?= $row['name']; ?></td>
                                            <td>
                                                <img src="../uploads/<?= $row['image']; ?>" alt="Product image" width="50px" height="50px">    
                                            </td>
                                            <td>
                                                <?php
                                                if($row['status'] == '0')
                                                {
                                                    echo '<span class="bg-success badge badge-pill">Visible</span>';
                                                }else
                                                {
                                                    echo '<span class="bg-danger badge badge-pill">Hidden</span>';
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                if($row['trending'] == '1')
                                                {
                                                    echo '<span class="bg-success badge badge-pill text-white">Yes</span>';
                                                }else
                                                {
                                                    echo '<span class="bg-secondary badge badge-pill text-white">No</span>';
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                if($row['today_special'] == '1')
                                                {
                                                    echo '<span class="bg-success badge badge-pill text-white">Yes</span>';
                                                }else
                                                {
                                                    echo '<span class="bg-secondary badge badge-pill text-white">No</span>';
                                                }
                                                ?>
                                            </td>
                                            <td><a href="edit-product.php?id=<?= $row['id']; ?>" class="btn btn-primary">Edit</a></td>
                                            <td><a href="delete-product.php?id=<?= $row['id']; ?>" class="btn btn-danger">Delete</a></td>
                                        </tr>
                                        <?php
                                    }
                                }
                                else
                                {
                                ?>
                                    <tr>
                                        <td colspan="6">No Record Found</td>
                                    </tr>
                                <?php
                                }
                                ?>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<?php
include('includes/footer.php');
include('includes/scripts.php');
?>