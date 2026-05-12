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
                <h1>Edit User</h1>

                <div class="row">
                    <div class="col-sm-12 col-md-8">

                        <?php 
                            if (!isset($_GET['id'])) {
                                header("Location: view-users.php");
                                exit;
                            }
                            $id = intval($_GET['id']);
                            $sql = "SELECT * FROM users WHERE id = $id";
                            $result = mysqli_query($conn, $sql);
                            $user = mysqli_fetch_assoc($result);

                            if (!$user) {
                                echo "<div class='alert alert-danger'>User not found!</div>";
                                exit;
                            }

                            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                $username = mysqli_real_escape_string($conn, $_POST['username']);
                                
                                if (!empty($_POST['password'])) {
                                    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                                    $sql = "UPDATE users SET username = '$username', password = '$password' WHERE id = $id";
                                } else {
                                    $sql = "UPDATE users SET username = '$username' WHERE id = $id";
                                }

                                if (mysqli_query($conn, $sql)) {
                                    echo "<div class='alert alert-success'>User updated successfully!</div>";
                                    header("Refresh:1; url=view-users.php");
                                } else {
                                    echo "<div class='alert alert-danger'>Error: " . mysqli_error($conn) . "</div>";
                                }
                            }
                        ?>
                        <form method="POST">
                            <div class="form-group">
                                <label for="userName">User Name</label>
                                <input type="text" class="form-control" name="username" id="userName" value="<?php echo $user['username']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="userPassword">Password (leave blank to keep current)</label>
                                <input type="password" class="form-control" name="password" id="userPassword" placeholder="Enter new password">
                            </div>
                            <button type="submit" class="btn btn-primary">Update User</button>
                        </form>

                    </div>

                    <div class="col-sm-12 col-md-4"></div>
                </div>


            </div>
        </main>

    </div>

<?php include '../../footer.php'; ?>
