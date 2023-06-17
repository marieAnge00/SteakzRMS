<?php
include('authentication.php');
include('includes/header.php');
?>

<div class="container-fluid px-4">
    <div class="row mt-5">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Registered User</h4>
                </div>
                <div class="card-body">

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Active Status</th>
                                <th>Roles</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT * FROM users";
                            $query_run = mysqli_query($con, $query);

                            if(mysqli_num_rows($query_run) > 0)
                            {
                                foreach($query_run as $row)
                                {
                                    ?>
                                    <tr>
                                        <td><?= $row['id']; ?></td>
                                        <td><?= $row['fname']; ?></td>
                                        <td><?= $row['lname']; ?></td>
                                        <td><?= $row['email']; ?></td>
                                        <td>
                                            <?php
                                            if($row['status'] == '1'){
                                                echo '<span class="bg-danger badge badge-pill">Banned</span>';
                                            }elseif($row['status'] == '0'){
                                                echo '<span class="bg-success badge badge-pill">Active</span>';
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            if($row['role_as'] == '1'){
                                                echo 'Admin';
                                            }elseif($row['role_as'] == '0'){
                                                echo 'User';
                                            }
                                            ?>
                                        </td>
                                        <td><a href="edit-user.php?id=<?= $row['id']; ?>" class="btn btn-primary">Edit</a></td>
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

<?php
include('includes/footer.php');
include('includes/scripts.php');
?>