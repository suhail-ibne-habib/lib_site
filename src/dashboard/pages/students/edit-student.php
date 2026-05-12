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
                <h1>Edit Student</h1>

                <div class="row">
                    <div class="col-sm-12 col-md-8">

                        <?php 
                            if (!isset($_GET['id'])) {
                                header("Location: view-students.php");
                                exit;
                            }
                            $id = intval($_GET['id']);
                            $sql = "SELECT * FROM students WHERE id = $id";
                            $result = mysqli_query($conn, $sql);
                            $student = mysqli_fetch_assoc($result);

                            if (!$student) {
                                echo "<div class='alert alert-danger'>Student not found!</div>";
                                exit;
                            }

                            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                $name = mysqli_real_escape_string($conn, $_POST['name']);
                                $email = mysqli_real_escape_string($conn, $_POST['email']);
                                $enrolled_at = mysqli_real_escape_string($conn, $_POST['enrolled_at']);

                                $sql = "UPDATE students SET name = '$name', email = '$email', enrolled_at = '$enrolled_at' WHERE id = $id";

                                if (mysqli_query($conn, $sql)) {
                                    echo "<div class='alert alert-success'>Student updated successfully!</div>";
                                    header("Refresh:1; url=view-students.php");
                                } else {
                                    echo "<div class='alert alert-danger'>Error: " . mysqli_error($conn) . "</div>";
                                }
                            }
                        ?>
                        <form method="POST">
                            <div class="form-group">
                                <label for="studentName">Student Name</label>
                                <input type="text" class="form-control" name="name" id="studentName" value="<?php echo $student['name']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="studentEmail">Email</label>
                                <input type="email" class="form-control" name="email" id="studentEmail" value="<?php echo $student['email']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="enrolledAt">Enrolled At</label>
                                <input type="date" class="form-control" name="enrolled_at" id="enrolledAt" value="<?php echo $student['enrolled_at']; ?>" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </form>

                    </div>

                    <div class="col-sm-12 col-md-4"></div>
                </div>


            </div>
        </main>

    </div>

<?php include '../../footer.php'; ?>
