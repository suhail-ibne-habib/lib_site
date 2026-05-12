<?php
// Database configuration
$host = "localhost";
$dbname = "lib";
$username = "lib";
$password = "lib";

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// -------------------- 1. Create users table --------------------
$sql_users = "CREATE TABLE IF NOT EXISTS users (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB";

$conn->query($sql_users);

// -------------------- 2. Create books table --------------------
$sql_books = "CREATE TABLE IF NOT EXISTS books (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    author VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    genre TEXT NOT NULL,
    cover VARCHAR(255),
    copies INT(11) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB";

$conn->query($sql_books);

// -------------------- 3. Create students table --------------------
$sql_students = "CREATE TABLE IF NOT EXISTS students (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    enrolled_at DATE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB";

$conn->query($sql_students);

// -------------------- 4. Borrows table --------------------
$sql_borrows = "CREATE TABLE IF NOT EXISTS borrows (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    student_id INT(11) UNSIGNED NOT NULL,
    book_id INT(11) UNSIGNED NOT NULL,
    borrow_date DATE NOT NULL,
    due_date DATE NOT NULL,
    return_date DATE DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (student_id) REFERENCES students(id) ON DELETE CASCADE,
    FOREIGN KEY (book_id) REFERENCES books(id) ON DELETE CASCADE
) ENGINE=InnoDB";

$conn->query($sql_borrows);

// -------------------- 5. Create default admin user --------------------
$admin_username = "admin";
$admin_password = password_hash("admin123", PASSWORD_DEFAULT); // secure hash

// Check if admin exists
$check_admin = $conn->prepare("SELECT * FROM users WHERE username = ?");
$check_admin->bind_param("s", $admin_username);
$check_admin->execute();
$result = $check_admin->get_result();

if ($result->num_rows == 0) {
    // Insert admin user
    $insert_admin = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $insert_admin->bind_param("ss", $admin_username, $admin_password);
    if ($insert_admin->execute()) {
        echo "Admin user created.<br>";
    } else {
        echo "Error creating admin user: " . $conn->error . "<br>";
    }
} 

