<?php 
ob_start();
$currentPage = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Website</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="../assets/favicon.ico" type="image/x-icon">
</head>
<body>
    <header class="text-dark text-white text-center py-5">
        <h1>Welcome to Our Library</h1>
        <p>Your gateway to knowledge and resources</p>
    </header>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item <?php if($currentPage == 'index.php' || $currentPage == 'index.html') echo 'active'; ?>">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item <?php if($currentPage == 'catalog.php' || $currentPage == 'catalog.html') echo 'active'; ?>">
                    <a class="nav-link" href="catalog.php">Catalog</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Login</a>
                </li>
            </ul>
        </div>
    </nav>