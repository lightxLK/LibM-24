<?php
// Start the session
session_start();
require 'db_config.php';

// Redirect if the user is not logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit;
}

// Function to update the books.json file after adding a new book
function updateJsonFile($conn) {
    $query = "SELECT * FROM books";
    $result = $conn->query($query);
    $books = [];

    while ($row = $result->fetch_assoc()) {
        $books[] = $row;
    }

    // Save the books array to books.json
    file_put_contents('books.json', json_encode($books, JSON_PRETTY_PRINT));
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve form data
    $title = $_POST['title'] ?? '';
    $author = $_POST['author'] ?? '';
    $publication_year = $_POST['publication_year'] ?? 0;
    $genre = $_POST['genre'] ?? '';

    // Validate form data
    if (empty($title) || empty($author) || empty($publication_year) || empty($genre)) {
        echo "<script>alert('All fields are required.'); window.location.href='add_book.php';</script>";
        exit;
    }

    // Insert data into the database
    $stmt = $conn->prepare("INSERT INTO books (title, author, publication_year, genre) VALUES (?, ?, ?, ?)");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("ssis", $title, $author, $publication_year, $genre);

    if ($stmt->execute()) {
        updateJsonFile($conn); // Update the JSON file after adding the book
        echo "<script>alert('Book added successfully!'); window.location.href='add_book.php';</script>";
        exit;
    } else {
        die("Error adding book: " . $stmt->error);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Book</title>
    <link rel="stylesheet" href="common.css">
</head>
<body>
    <?php include 'navbar.php'; ?>

    <main>
        <h1>Add a New Book</h1>
        <form action="add_book.php" method="POST">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required><br>

            <label for="author">Author:</label>
            <input type="text" id="author" name="author" required><br>

            <label for="publication_year">Publication Year:</label>
            <input type="number" id="publication_year" name="publication_year" min="2000" required><br>

            <label for="genre">Genre:</label>
            <input type="text" id="genre" name="genre" required><br>

            <button type="submit">Add Book</button>
        </form>
    </main>
</body>
</html>