<?php
    require_once '../../header.php';

    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        $title = trim($_POST['title']);
        $author = trim($_POST['author']);
        $copies = intval($_POST['copies']);
        $genre = trim($_POST['genre']);
        $description = trim($_POST['description']);

        // Handle cover upload
        $coverPath = null;
        if (isset($_FILES['cover']) && $_FILES['cover']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = "../../assets/covers/"; // create this folder if it doesn't exist
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $fileName = time() . "_" . basename($_FILES['cover']['name']);
            $targetFile = $uploadDir . $fileName;

            if (move_uploaded_file($_FILES['cover']['tmp_name'], $targetFile)) {
                $coverPath = "assets/covers/" . $fileName; // relative path for DB
            } else {
                echo "<div class='alert alert-danger'>❌ Failed to upload cover image.</div>";
            }
        }

        // Insert into DB
        $stmt = $conn->prepare("INSERT INTO books (title, author, description, copies, genre, cover, created_at) 
                                VALUES (?, ?, ?, ?, ?, ?, NOW())");
        $stmt->bind_param("sssiss", $title, $author, $description, $copies, $genre, $coverPath);

        if ($stmt->execute()) {
            echo "<div class='alert alert-success'>✅ Book added successfully!</div>";
        } else {
            echo "<div class='alert alert-danger'>❌ Error: " . $stmt->error . "</div>";
        }

        $stmt->close();
    }

?>

    <div class="dashboard d-flex">

        <!-- Sidebar  -->
        <?php include '../../sidebar.php' ?>
        <!-- Dashboard Main  -->
        <main class="dashboard-main flex-grow-1">
            <div class="dashboard-main-nav">
                <?php include '../../nav.php' ?>
            </div>
            <div class="dashboard-container p-3">
                <h1>Create New Book</h1>
                <p>Welcome to the library dashboard. Here you can manage books, users, and settings.</p>

                <div class="row">
                    <div class="col-sm-12 col-md-8">

                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="bookTitle">Book Title</label>
                                <input type="text" class="form-control" id="bookTitle" name="title" placeholder="Enter book title">
                            </div>
                            <div class="form-group">
                                <label for="bookAuthor">Author</label>
                                <input type="text" class="form-control" id="bookAuthor" name="author" placeholder="Enter author name">
                            </div>
                            <div class="form-group">
                                <label for="copies">Copies</label>
                                <input type="number" class="form-control" id="copies" name="copies" placeholder="Copies">
                            </div>
                            <div class="form-group">
                                <label for="bookGenre">Genre</label>
                                <select name="genre" class="custom-select" >
                                    <option value="history">History</option>
                                    <option value="fiction">Fiction</option>
                                    <option value="non-fiction">Non-Fiction</option>
                                    <option value="science">Science & Technology</option>
                                    <option value="biography">Biographies & Memoirs</option>
                                    <option value="children">Children’s Books</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="bookDescription">Description</label>
                                <textarea class="form-control" id="bookDescription" rows="3" name="description" placeholder="Enter book description"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="bookCover">Book Cover</label>
                                <input type="file" class="form-control-file" id="bookCover" name="cover" accept="image/*" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Create Book</button>
                        </form>

                    </div>

                    <div class="col-sm-12 col-md-4"></div>
                </div>


            </div>
        </main>

    </div>

<?php include '../../footer.php'; ?>
