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
                <h1>Create New Student</h1>

                <div class="row">
                    <div class="col-sm-12 col-md-8">

                        <?php 
                            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                $name = mysqli_real_escape_string($conn, $_POST['name']);
                                $email = mysqli_real_escape_string($conn, $_POST['email']);
                                $enrolled_at = mysqli_real_escape_string($conn, $_POST['enrolled_at']);

                                $sql = "INSERT INTO students (name, email, enrolled_at) VALUES ('$name', '$email', '$enrolled_at')";

                                if (mysqli_query($conn, $sql)) {
                                    echo "<div class='alert alert-success'>Student created successfully!</div>";
                                    header("Refresh:1; url=view-students.php");
                                } else {
                                    echo "<div class='alert alert-danger'>Error: " . mysqli_error($conn) . "</div>";
                                }
                            }
                        ?>
                        <form method="POST">
                            <div class="form-group">
                                <label for="studentName">Student Name</label>
                                <input type="text" class="form-control" name="name" id="studentName" placeholder="Enter student name" required>
                            </div>
                            <div class="form-group">
                                <label for="studentEmail">Email</label>
                                <input type="email" class="form-control" name="email" id="studentEmail" placeholder="Enter student email" required>
                            </div>
                            <div class="form-group">
                                <label for="enrolledAt">Enrolled At</label>
                                <input type="date" class="form-control" name="enrolled_at" id="enrolledAt" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Create Student</button>
                        </form>

                    </div>

                    <div class="col-sm-12 col-md-4"></div>
                </div>


            </div>
        </main>

    </div>

<?php include '../../footer.php'; ?>
