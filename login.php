<?php
session_start();
require 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username_email = $_POST['username_email'];
    $password = $_POST['password'];

    // Check if user exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? OR username = ?");
    $stmt->bind_param("ss", $username_email, $username_email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header("Location: dashboard.html");
        exit;
    } else {
        echo "Invalid credentials. <a href='login.html'>Try again</a>";
    }
}
?>