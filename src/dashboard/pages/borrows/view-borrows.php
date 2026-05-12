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
                <h1>Manage Borrows</h1>

                <div class="row">
                    <div class="col-sm-12 col-md-12">

                        <table class="literature-table">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Student</th>
                                    <th>Book</th>
                                    <th>Borrow Date</th>
                                    <th>Due Date</th>
                                    <th>Status</th>
                                    <th>Fine (BDT)</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $sql = "SELECT b.*, s.name as student_name, bk.title as book_title 
                                            FROM borrows b 
                                            JOIN students s ON b.student_id = s.id 
                                            JOIN books bk ON b.book_id = bk.id 
                                            ORDER BY b.borrow_date DESC";
                                    $result = mysqli_query($conn, $sql);
                                    if ($result && mysqli_num_rows($result) > 0) {
                                        while ($borrow = mysqli_fetch_assoc($result)) {
                                            $today = date('Y-m-d');
                                            $end_date = $borrow['return_date'] ? $borrow['return_date'] : $today;
                                            
                                            $fine = 0;
                                            if ($end_date > $borrow['due_date']) {
                                                $datetime1 = new DateTime($borrow['due_date']);
                                                $datetime2 = new DateTime($end_date);
                                                $interval = $datetime1->diff($datetime2);
                                                $days = $interval->format('%a');
                                                $fine = $days * 30;
                                            }

                                            $is_overdue = ($today > $borrow['due_date'] && is_null($borrow['return_date']));
                                            $status = is_null($borrow['return_date']) ? ($is_overdue ? "<span class='text-danger'>Overdue</span>" : "<span class='text-success'>Active</span>") : "Returned";
                                ?>
                                    <tr>
                                        <td><?php echo $borrow['id']; ?></td>
                                        <td><?php echo $borrow['student_name']; ?></td>
                                        <td><?php echo $borrow['book_title']; ?></td>
                                        <td><?php echo $borrow['borrow_date']; ?></td>
                                        <td><?php echo $borrow['due_date']; ?></td>
                                        <td><?php echo $status; ?></td>
                                        <td><strong><?php echo $fine; ?></strong></td>
                                        <td>
                                            <?php if (is_null($borrow['return_date'])): ?>
                                                <a href="return-book.php?id=<?php echo $borrow['id']; ?>" class="btn-edit" style="background-color: #28a745;">Return</a>
                                            <?php endif; ?>
                                            <a href="edit-borrow.php?id=<?php echo $borrow['id']; ?>" class="btn-edit">Edit</a>
                                            <a href="../delete.php?tb=borrow&id=<?php echo $borrow['id']; ?>" class="btn-delete" onclick="return confirm('Are you sure?')">Delete</a>
                                        </td>
                                    </tr>
                                <?php 
                                        }
                                    } else {
                                        echo "<tr><td colspan='7'>No borrows found.</td></tr>";
                                    }
                                ?>
                            </tbody>
                        </table>

                    </div>
                </div>

            </div>
        </main>

    </div>

<?php include '../../footer.php'; ?>
