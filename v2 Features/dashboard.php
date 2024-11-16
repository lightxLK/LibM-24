<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit;
}

$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="common.css">
</head>
<body>
    <?php include 'navbar.php'; ?>

    <main>
        <h1>Welcome to Your Dashboard</h1>
        <p>Hello, <?php echo htmlspecialchars($username); ?>! Here are your options:</p>
        <div class="actions">
            <a href="add_book.php" class="btn">Add a Book</a>
            <a href="search_books.html" class="btn">Search Books</a>
        </div>
    </main>
</body>
</html>
