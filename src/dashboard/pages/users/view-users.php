<?php 
    include "../../header.php";
?>

    <div class="dashboard d-flex">

        <!-- Sidebar  -->
        <?php include '../../sidebar.php' ?>

        <!-- Dashboard Main  -->
        <main class="dashboard-main flex-grow-1">
            <!-- Nav  -->
            <?php include '../../nav.php'; ?>

            <div class="dashboard-container p-3">
                <h1>View Users</h1>

                <div class="row">
                    <div class="col-sm-12 col-md-12">

                        <table class="literature-table">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Username</th>
                                    <th>Created At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $sql = "SELECT * FROM users";
                                    $result = mysqli_query($conn, $sql);
                                    if ($result && mysqli_num_rows($result) > 0) {
                                        while ($user = mysqli_fetch_assoc($result)) {
                                ?>
                                    <tr>
                                        <td><?php echo $user['id']; ?></td>
                                        <td><?php echo $user['username']; ?></td>
                                        <td><?php echo $user['created_at']; ?></td>
                                        <td>
                                            <a href="edit-user.php?id=<?php echo $user['id']; ?>" class="btn-edit">Edit</a>
                                            <a href="../delete.php?tb=user&id=<?php echo $user['id']; ?>" class="btn-delete" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                                        </td>
                                    </tr>
                                <?php 
                                        }
                                    } else {
                                        echo "<tr><td colspan='4'>No users found.</td></tr>";
                                    }
                                ?>
                            </tbody>
                        </table>

                    </div>

                    <div class="col-sm-12 col-md-4"></div>
                </div>


            </div>
        </main>

    </div>

<?php include '../../footer.php'; ?>
