<?php 
include "../../header.php";

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    
    // Get book_id first to increment copies
    $sql_get = "SELECT book_id FROM borrows WHERE id = $id";
    $res_get = mysqli_query($conn, $sql_get);
    $borrow = mysqli_fetch_assoc($res_get);

    if ($borrow) {
        $book_id = $borrow['book_id'];
        $return_date = date('Y-m-d');

        // Start transaction
        mysqli_begin_transaction($conn);

        try {
            // Update borrows table
            $sql_update = "UPDATE borrows SET return_date = '$return_date' WHERE id = $id";
            mysqli_query($conn, $sql_update);

            // Update books table
            $sql_book = "UPDATE books SET copies = copies + 1 WHERE id = $book_id";
            mysqli_query($conn, $sql_book);

            mysqli_commit($conn);
            header("Location: view-borrows.php");
        } catch (Exception $e) {
            mysqli_rollback($conn);
            echo "Error returning book: " . $e->getMessage();
        }
    }
} else {
    header("Location: view-borrows.php");
}
?>
