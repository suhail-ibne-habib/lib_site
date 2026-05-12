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
                <h1>Create New User</h1>

                <div class="row">
                    <div class="col-sm-12 col-md-8">

                        <?php 
                            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                $username = mysqli_real_escape_string($conn, $_POST['username']);
                                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

                                $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";

                                if (mysqli_query($conn, $sql)) {
                                    echo "<div class='alert alert-success'>User created successfully!</div>";
                                    header("Refresh:1; url=view-users.php");
                                } else {
                                    echo "<div class='alert alert-danger'>Error: " . mysqli_error($conn) . "</div>";
                                }
                            }
                        ?>
                        <form method="POST">
                            <div class="form-group">
                                <label for="userName">User Name</label>
                                <input type="text" class="form-control" name="username" id="userName" placeholder="Enter user name" required>
                            </div>
                            <div class="form-group">
                                <label for="userPassword">Password</label>
                                <input type="password" class="form-control" name="password" id="userPassword" placeholder="Enter user password" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Create User</button>
                        </form>

                    </div>

                    <div class="col-sm-12 col-md-4"></div>
                </div>


            </div>
        </main>

    </div>

<?php include '../../footer.php'; ?>
