<?php 
    include '../../db/connect.php';

    if (isset($_GET['id']) && isset($_GET['tb'])) {
        $id = intval($_GET['id']);
        $table = $_GET['tb'];

        // Map table parameter to actual table names
        $table_map = [
            'book' => 'books',
            'user' => 'users',
            'student' => 'students',
            'borrow' => 'borrows'
        ];

        if (array_key_exists($table, $table_map)) {
            $db_table = $table_map[$table];
            $sql = "DELETE FROM $db_table WHERE id = $id";

            if (mysqli_query($conn, $sql)) {
                // Redirect after successful deletion based on table
                if ($table == 'book') {
                    header("Location: books/view-books.php");
                } elseif ($table == 'user') {
                    header("Location: users/view-users.php");
                } elseif ($table == 'student') {
                    header("Location: students/view-students.php");
                } elseif ($table == 'borrow') {
                    header("Location: borrows/view-borrows.php");
                }
                exit();
            } else {
                echo "Error deleting record: " . mysqli_error($conn);
            }
        } else {
            echo "Invalid table specified.";
        }
    } else {
        echo "Missing parameters.";
    }

    // Close connection
    mysqli_close($conn);
?>
