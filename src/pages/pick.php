<?php 
include "header.php";
include "../db/connect.php";

$book_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$book = null;

if ($book_id > 0) {
    $sql = "SELECT * FROM books WHERE id = $book_id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $book = $result->fetch_assoc();
    }
}

if (!$book):
?>
    <main class="container mt-5 full-height text-center">
        <h2>Book not found.</h2>
        <a href="index.php" class="btn btn-primary mt-3">Back to Home</a>
    </main>
<?php elseif ($book['copies'] <= 0): ?>
    <main class="container mt-5 full-height text-center">
        <h2>Sorry, this book is currently out of stock.</h2>
        <a href="index.php" class="btn btn-primary mt-3">Back to Home</a>
    </main>
<?php else: ?>
    <?php 
        $message = "";
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $student_id = intval($_POST['student_id']);
            $borrow_date = date('Y-m-d');
            $due_date = date('Y-m-d', strtotime('+15 days'));

            // Check if student already has 2 unreturned books
            $check_sql = "SELECT COUNT(*) as active_borrows FROM borrows WHERE student_id = $student_id AND return_date IS NULL";
            $check_res = $conn->query($check_sql);
            $check_row = $check_res->fetch_assoc();

            if ($check_row['active_borrows'] >= 2) {
                $message = "<div class='alert alert-danger'>❌ Error: This student already has 2 active borrows. Please return a book first.</div>";
            } else {
                // Start transaction
                $conn->begin_transaction();

                try {
                    // Insert into borrows
                    $stmt = $conn->prepare("INSERT INTO borrows (student_id, book_id, borrow_date, due_date) VALUES (?, ?, ?, ?)");
                    $stmt->bind_param("iiss", $student_id, $book_id, $borrow_date, $due_date);
                    $stmt->execute();

                    // Update book copies
                    $stmt_update = $conn->prepare("UPDATE books SET copies = copies - 1 WHERE id = ?");
                    $stmt_update->bind_param("i", $book_id);
                    $stmt_update->execute();

                    $conn->commit();
                    $message = "<div class='alert alert-success'>✅ Book issued successfully! Due date: $due_date</div>";
                    // Refresh book data
                    $result = $conn->query($sql);
                    $book = $result->fetch_assoc();
                } catch (Exception $e) {
                    $conn->rollback();
                    $message = "<div class='alert alert-danger'>❌ Error: " . $e->getMessage() . "</div>";
                }
            }
        }
    ?>

    <main class="container mt-5 full-height">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card p-4">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="../dashboard/<?php echo $book['cover']; ?>" class="img-fluid rounded" alt="<?php echo $book['title']; ?>">
                        </div>
                        <div class="col-md-8">
                            <h2>Issue Book: <?php echo $book['title']; ?></h2>
                            <p class="text-muted">Author: <?php echo $book['author']; ?></p>
                            <p>Available Copies: <strong><?php echo $book['copies']; ?></strong></p>
                            
                            <?php echo $message; ?>

                            <?php if ($book['copies'] > 0): ?>
                            <form method="POST" class="mt-4">
                                <div class="form-group">
                                    <label for="studentSelect">Select Student</label>
                                    <select name="student_id" id="studentSelect" class="form-control" required>
                                        <option value="">-- Choose a Student --</option>
                                        <?php 
                                            $students_sql = "SELECT id, name, email FROM students ORDER BY name ASC";
                                            $students_result = $conn->query($students_sql);
                                            while($student = $students_result->fetch_assoc()) {
                                                echo "<option value='{$student['id']}'>{$student['name']} ({$student['email']})</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="mt-3">
                                    <p><strong>Terms:</strong> 15 days borrowing period.</p>
                                    <button type="submit" class="btn btn-success btn-block">Issue Book to Student</button>
                                </div>
                            </form>
                            <?php endif; ?>
                            <a href="catalog.php" class="btn btn-link btn-block mt-2">Back to Catalog</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php endif; ?>

<?php include "footer.php"; ?>