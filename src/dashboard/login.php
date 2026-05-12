<?php
session_start();

require_once "../db/connect.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username']); 
    $password = $_POST['password'];

    // Prepared statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT id, username, password, created_at FROM users WHERE username = ? LIMIT 1");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($user = $result->fetch_assoc()) {
        // Verify password (hashed)
        if (password_verify($password, $user['password'])) {
            // ✅ Correct credentials → create session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['created_at'] = $user['created_at'];

            // Redirect to dashboard
            header("Location: index.php");
            exit;
        } else {
            $error = "Invalid password!";
        }
    } else {
        $error = "No user found with that username/email.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Library</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <div class="container login-page">
        <h1 class="mt-5 login-title">Login</h1>
        
        <form class="login-form" method="POST" action="">

            <div class="form-group login-form-group">
                <label for="username" class="login-label">Username</label>
                <input type="text" class="form-control login-input" id="username" name="username" placeholder="Enter your username" required>
            </div>
            <div class="form-group login-form-group">
                <label for="password" class="login-label">Password</label>
                <input type="password" class="form-control login-input" id="password" name="password" placeholder="Enter your password" required>
            </div>
            
            <button type="submit" class="btn btn-primary login-btn">Login</button>
        </form>
    </div>

</body>
</html>
