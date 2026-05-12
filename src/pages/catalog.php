<?php
    include "header.php";
    include "../db/connect.php";
?>

    <main class="container mt-4">

        <div class="row">
            <div class="col-12">
                <div class="search-wrapper">
                    <form action="catalog.php" method="GET" class="search-content">
                        <input type="text" name="q" id="searchQuery" placeholder="Search for books..." value="<?php echo isset($_GET['q']) ? htmlspecialchars($_GET['q']) : ''; ?>">
                        <input type="submit" value="SEARCH">
                    </form>
                </div>
            </div>
        </div>

        <!-- Book Lists  -->

        <div class="row">

            <div class="col-12">
                <h2 class="title">Books to PICK</h2>
            </div>

            <?php 
                $search = isset($_GET['q']) ? mysqli_real_escape_string($conn, $_GET['q']) : '';
                $sql = "SELECT * FROM books";
                if (!empty($search)) {
                    $sql .= " WHERE title LIKE '%$search%' OR author LIKE '%$search%' OR genre LIKE '%$search%'";
                }
                $sql .= " ORDER BY created_at DESC";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
            ?>
            <!-- Book Starts  -->
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="book">
                    <div class="book-feature">
                        <img src="../dashboard/<?php echo $row['cover']; ?>" alt="<?php echo $row['title']; ?>">
                    </div>
                    <div class="book-description">
                        <a href="single.php?id=<?php echo $row['id']; ?>" class="book-title"><?php echo $row['title']; ?></a>
                        <p class="book-short-details"><?php echo substr($row['description'], 0, 200) . (strlen($row['description']) > 200 ? '...' : ''); ?></p>
                        <div class="book-actions mt-2">
                            <a href="single.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm mr-2">View Now</a>
                            <?php if ($row['copies'] > 0): ?>
                                <a href="pick.php?id=<?php echo $row['id']; ?>" class="btn btn-success btn-sm">Pick Now</a>
                            <?php else: ?>
                                <button class="btn btn-secondary btn-sm" disabled>Out of Stock</button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php 
                    }
                } else {
                    echo "<div class='col-12'><p>No books found.</p></div>";
                }
            ?>

        </div>

    </main>

<?php 

    include "footer.php";

?>