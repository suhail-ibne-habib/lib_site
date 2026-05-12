<?php 
    require_once '../../header.php';

    if (!isset($_GET['id'])) {
        header("Location: view-books.php");
        exit;
    }

    $id = intval($_GET['id']);
    $sql = "SELECT * FROM books WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    $book = mysqli_fetch_assoc($result);

    if (!$book) {
        echo "<div class='alert alert-danger'>Book not found!</div>";
        exit;
    }

    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        $title = mysqli_real_escape_string($conn, trim($_POST['title']));
        $author = mysqli_real_escape_string($conn, trim($_POST['author']));
        $copies = intval($_POST['copies']);
        $genre = mysqli_real_escape_string($conn, trim($_POST['genre']));
        $description = mysqli_real_escape_string($conn, trim($_POST['description']));

        // Handle cover upload
        $coverPath = $book['cover']; // Default to current cover
        if (isset($_FILES['cover']) && $_FILES['cover']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = "../../assets/covers/"; 
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $fileName = time() . "_" . basename($_FILES['cover']['name']);
            $targetFile = $uploadDir . $fileName;

            if (move_uploaded_file($_FILES['cover']['tmp_name'], $targetFile)) {
                $coverPath = "assets/covers/" . $fileName; 
            }
        }

        // Update DB
        $sql_update = "UPDATE books SET 
                        title = '$title', 
                        author = '$author', 
                        description = '$description', 
                        copies = $copies, 
                        genre = '$genre', 
                        cover = '$coverPath' 
                       WHERE id = $id";

        if (mysqli_query($conn, $sql_update)) {
            echo "<div class='alert alert-success'>✅ Book updated successfully!</div>";
            header("Refresh:1; url=view-books.php");
            // Refresh local book data
            $book['title'] = $title;
            $book['author'] = $author;
            $book['copies'] = $copies;
            $book['genre'] = $genre;
            $book['description'] = $description;
            $book['cover'] = $coverPath;
        } else {
            echo "<div class='alert alert-danger'>❌ Error: " . mysqli_error($conn) . "</div>";
        }
    }

?>

    <div class="dashboard d-flex">

        <!-- Sidebar  -->
        <?php include '../../sidebar.php' ?>

        <!-- Dashboard Main  -->
        <main class="dashboard-main flex-grow-1">
            <!-- Nav  -->
            <?php include '../../nav.php'; ?>

            <div class="dashboard-container p-3">
                <h1>Edit Book</h1>

                <div class="row">
                    <div class="col-sm-12 col-md-8">

                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="bookTitle">Book Title</label>
                                <input type="text" class="form-control" id="bookTitle" name="title" value="<?php echo htmlspecialchars($book['title']); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="bookAuthor">Author</label>
                                <input type="text" class="form-control" id="bookAuthor" name="author" value="<?php echo htmlspecialchars($book['author']); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="copies">Copies</label>
                                <input type="number" class="form-control" id="copies" name="copies" value="<?php echo $book['copies']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="bookGenre">Genre</label>
                                <select name="genre" class="custom-select">
                                    <option value="history" <?php if($book['genre'] == 'history') echo 'selected'; ?>>History</option>
                                    <option value="fiction" <?php if($book['genre'] == 'fiction') echo 'selected'; ?>>Fiction</option>
                                    <option value="non-fiction" <?php if($book['genre'] == 'non-fiction') echo 'selected'; ?>>Non-Fiction</option>
                                    <option value="science" <?php if($book['genre'] == 'science') echo 'selected'; ?>>Science & Technology</option>
                                    <option value="biography" <?php if($book['genre'] == 'biography') echo 'selected'; ?>>Biographies & Memoirs</option>
                                    <option value="children" <?php if($book['genre'] == 'children') echo 'selected'; ?>>Children’s Books</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="bookDescription">Description</label>
                                <textarea class="form-control" id="bookDescription" rows="5" name="description" required><?php echo htmlspecialchars($book['description']); ?></textarea>
                            </div>

                            <div class="form-group">
                                <label for="bookCover">Book Cover (Leave blank to keep current)</label>
                                <div class="mb-2">
                                    <img src="../../<?php echo $book['cover']; ?>" width="100" class="img-thumbnail" alt="">
                                </div>
                                <input type="file" class="form-control-file" id="bookCover" name="cover" accept="image/*">
                            </div>

                            <button type="submit" class="btn btn-primary">Update Book</button>
                        </form>

                    </div>
                </div>

            </div>
        </main>

    </div>

<?php include '../../footer.php'; ?>
