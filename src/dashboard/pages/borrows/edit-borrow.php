<?php 
    require_once __DIR__ . "/../../db/connect.php";

    if (!isset($_GET['id'])) {
        header("Location: view-borrows.php");
        exit;
    }
    $id = intval($_GET['id']);
    
    $message = "";
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $due_date = mysqli_real_escape_string($conn, $_POST['due_date']);
        $sql_update = "UPDATE borrows SET due_date = '$due_date' WHERE id = $id";

        if (mysqli_query($conn, $sql_update)) {
            $message = "<div class='alert alert-success'>Record updated successfully!</div>";
            header("Refresh:1; url=view-borrows.php");
        } else {
            $message = "<div class='alert alert-danger'>Error: " . mysqli_error($conn) . "</div>";
        }
    }

    $sql = "SELECT b.*, s.name as student_name, bk.title as book_title 
            FROM borrows b 
            JOIN students s ON b.student_id = s.id 
            JOIN books bk ON b.book_id = bk.id 
            WHERE b.id = $id";
    $result = mysqli_query($conn, $sql);
    $borrow = mysqli_fetch_assoc($result);

    if (!$borrow) {
        die("Record not found!");
    }

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
                <h1>Edit Borrow Record</h1>

                <div class="row">
                    <div class="col-sm-12 col-md-8">

                        <?php echo $message; ?>
                        <div class="mb-4">
                            <p><strong>Student:</strong> <?php echo $borrow['student_name']; ?></p>
                            <p><strong>Book:</strong> <?php echo $borrow['book_title']; ?></p>
                            <p><strong>Borrowed Date:</strong> <?php echo $borrow['borrow_date']; ?></p>
                        </div>

                        <form method="POST">
                            <div class="form-group">
                                <label for="dueDate">Due Date</label>
                                <input type="date" class="form-control" name="due_date" id="dueDate" value="<?php echo $borrow['due_date']; ?>" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Update Record</button>
                        </form>

                    </div>
                </div>

            </div>
        </main>

    </div>

<?php include '../../footer.php'; ?>
