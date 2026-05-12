<?php 
ob_start();
session_start();

// Block access if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

require_once __DIR__ . "/../db/connect.php";

require_once __DIR__ . "/functions.php";

$BASE_URL = get_base_path();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Your custom CSS -->
    <link rel="stylesheet" href="<?php echo $BASE_URL; ?>src/dashboard/css/style.css">
</head>
<body>
