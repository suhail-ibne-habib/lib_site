<?php 
    include "header.php";
    include "../db/connect.php";
?>

    <main class="container mb-5">

        <div class="row">
            <div class="col-12">
                <div class="search-wrapper">
                    <form action="catalog.php" method="GET" class="search-content">
                        <input type="text" name="q" id="searchQuery" placeholder="Search for books...">
                        <input type="submit" value="SEARCH">
                    </form>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <h2 class="title">Categories</h2>
            </div>

            <!-- Category starts -->
            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="cat">
                    <div class="cat-feature">
                        <img src="../assets/history-cat.avif" alt="">
                    </div>
                    <a href="catalog.php?q=History" class="cat-link">History</a>
                </div>
            </div>
            <!-- Category Ends -->

            <!-- Category starts -->
            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="cat">
                    <div class="cat-feature">
                        <img src="../assets/fictional.avif" alt="">
                    </div>
                    <a href="catalog.php?q=Fiction" class="cat-link">Fiction</a>
                </div>
            </div>

            <!-- Category starts -->
            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="cat">
                    <div class="cat-feature">
                        <img src="../assets/non-fictional.avif" alt="">
                    </div>
                    <a href="catalog.php?q=Non-Fiction" class="cat-link">Non-Fiction</a>
                </div>
            </div>

            <!-- Category starts -->
            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="cat">
                    <div class="cat-feature">
                        <img src="../assets/Science & Technology.avif" alt="">
                    </div>
                    <a href="catalog.php?q=Science" class="cat-link">Science & Technology</a>
                </div>
            </div>

            <!-- Category starts -->
            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="cat">
                    <div class="cat-feature">
                        <img src="../assets/Biographies & Memoirs.avif" alt="">
                    </div>
                    <a href="catalog.php?q=Biography" class="cat-link">Biographies & Memoirs</a>
                </div>
            </div>

            <!-- Category starts -->
            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="cat">
                    <div class="cat-feature">
                        <img src="../assets/Children’s Books.avif" alt="">
                    </div>
                    <a href="catalog.php?q=Children" class="cat-link">Children’s Books</a>
                </div>
            </div>


        </div>
    
        <div class="row">

            <div class="col-12">
                <h2 class="title">Top Books to PICK</h2>
            </div>

            <?php 
                $sql = "SELECT * FROM books ORDER BY created_at DESC LIMIT 7";
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