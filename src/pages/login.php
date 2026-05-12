<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Library</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <div class="container login-page">
        <h1 class="mt-5 login-title">Login</h1>
        
        <form class="login-form">

            <a href="./index.html" class="home-icon" title="Go to Home">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M8 3.293l6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6zm5 6.414V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V9.707l5-5 5 5z"/>
                    <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6 6a1 1 0 0 1-1.414 1.414L8 3.914 2.707 8.914A1 1 0 0 1 1.293 7.5l6-6z"/>
                </svg>
            </a>

            <div class="form-group login-form-group">
                <label for="email" class="login-label">Email</label>
                <input type="email" class="form-control login-input" id="email" placeholder="Enter your email" required>
            </div>
            <div class="form-group login-form-group">
                <label for="password" class="login-label">Password</label>
                <input type="password" class="form-control login-input" id="password" placeholder="Enter your password" required>
            </div>
            
            <button type="submit" class="btn btn-primary login-btn">Login</button>
        </form>
    </div>

    <script src="../js/main.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>