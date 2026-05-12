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
                <h1>View Students</h1>

                <div class="row">
                    <div class="col-sm-12 col-md-12">

                        <table class="literature-table">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Enrolled At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $sql = "SELECT * FROM students";
                                    $result = mysqli_query($conn, $sql);
                                    if ($result && mysqli_num_rows($result) > 0) {
                                        while ($student = mysqli_fetch_assoc($result)) {
                                ?>
                                    <tr>
                                        <td><?php echo $student['id']; ?></td>
                                        <td><?php echo $student['name']; ?></td>
                                        <td><?php echo $student['email']; ?></td>
                                        <td><?php echo $student['enrolled_at']; ?></td>
                                        <td>
                                            <a href="edit-student.php?id=<?php echo $student['id']; ?>" class="btn-edit">Edit</a>
                                            <a href="../delete.php?tb=student&id=<?php echo $student['id']; ?>" class="btn-delete" onclick="return confirm('Are you sure you want to delete this student?')">Delete</a>
                                        </td>
                                    </tr>
                                <?php 
                                        }
                                    } else {
                                        echo "<tr><td colspan='5'>No students found.</td></tr>";
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
