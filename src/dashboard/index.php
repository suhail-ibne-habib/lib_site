<?php 
    include "header.php";
?>

    <div class="dashboard d-flex">

        <!-- Sidebar  -->
        <?php include 'sidebar.php' ?>
        <!-- Dashboard Main  -->
        <main class="dashboard-main flex-grow-1">
            <?php include 'nav.php' ?>
            <div class="dashboard-container p-3">
                <h1>Dashboard Overview</h1>
                <p>Welcome to the library dashboard. Here you can manage books, users, and settings.</p>
            </div>
        </main>

    </div>

<?php include 'footer.php'; ?>
