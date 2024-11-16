<?php
require 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Check if email already exists
    $checkQuery = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $checkQuery->bind_param("s", $email);
    $checkQuery->execute();
    $result = $checkQuery->get_result();

    if ($result->num_rows > 0) {
        echo "<div class='error'>Email already exists! <a href='register.html'>Go back</a></div>";
        exit;
    }

    // Insert user into the database
    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $password);

    if ($stmt->execute()) {
        echo "<div class='success'>Registration successful! <a href='login.html'>Login here</a></div>";
    } else {
        echo "<div class='error'>Error registering user. Please try again.</div>";
    }
}
?>