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
<?php else: ?>
    <main class="container mt-5 full-height">

        <div class="single-book row">
            <div class="col-sm-12 col-md-4 feature-img">

                <div class="card p-2">
                    <img src="../dashboard/<?php echo $book['cover']; ?>" class="img-fluid" alt="<?php echo $book['title']; ?>">
                </div>
            </div>
            <div class="col-sm-12 col-md-8">                

                <div class="card-body">
                    <h5 class="card-title"><?php echo $book['title']; ?></h5>
                    <p class="card-text">Author: <?php echo $book['author']; ?></p>
                    <p class="card-text">Genre: <?php echo $book['genre']; ?></p>
                    <p class="card-text">Description: <?php echo $book['description']; ?></p>
                    <p class="card-text">Available Copies: <?php echo $book['copies']; ?></p>
                    <?php if ($book['copies'] > 0): ?>
                        <a href="pick.php?id=<?php echo $book['id']; ?>" class="btn btn-primary btn-custom">Pick Now</a>
                    <?php else: ?>
                        <button class="btn btn-secondary btn-custom" disabled>Out of Stock</button>
                    <?php endif; ?>
                </div>
                
            </div>
        </div>

    </main>
<?php endif; ?>

<?php 
    include "footer.php";
?>