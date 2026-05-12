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
                <h1>View Books</h1>

                <div class="row">
                    <div class="col-sm-12 col-md-12">

                        <table class="literature-table">
                            <thead>
                                <tr>
                                    <th>Cover</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Description</th>
                                    <th>Genre</th>
                                    <th>Copies</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $sql = "SELECT * FROM books";
                                    $result = mysqli_query($conn, $sql);

                                    if ($result) {
                                        // Check if there are any rows
                                        if (mysqli_num_rows($result) > 0) {
                                            // Loop through each book
                                            while ($book = mysqli_fetch_assoc($result)) {
                                ?>

                                    <tr>
                                        <td><img class="book-table-img" src="../../<?php echo $book['cover'] ?>" /></td>
                                        <td><?php echo $book['title']; ?></td>
                                        <td><?php echo $book['author']; ?></td>
                                        <td><?php echo substr($book['description'], 0, 100); ?>...</td>
                                        <td><?php echo $book['genre']; ?></td>
                                        <td><?php echo $book['copies']; ?></td>
                                        <td>
                                            <a href="edit-book.php?id=<?php echo $book['id']; ?>" class="btn-edit">Edit</a>
                                            <a href="../delete.php?tb=book&id=<?php echo $book['id'] ?>" class="btn-delete">Delete</a>
                                        </td>
                                    </tr>

                                <?php 
                                            }
                                        } else {
                                            echo "No books found.";
                                        }
                                    } else {
                                        echo "Error: " . mysqli_error($conn);
                                    }

                                    // Close connection if needed
                                    mysqli_close($conn);
                                ?>
                                
                                <!-- <tr>
                                    <td>Book Title 2</td>
                                    <td>Author 2</td>
                                    <td>Genre 2</td>
                                    <td>
                                        <a href="#" class="btn-edit">Edit</a>
                                        <a href="#" class="btn-delete">Delete</a>
                                    </td>
                                </tr> -->
                            </tbody>
                        </table>

                    </div>

                    
                </div>


            </div>
        </main>

    </div>

<?php include '../../footer.php'; ?>
