<?php
session_start();
require 'db_config.php';

// Function to update the books.json file
function updateJsonFile($conn) {
    $query = "SELECT * FROM books";
    $result = $conn->query($query);
    $books = [];

    while ($row = $result->fetch_assoc()) {
        $books[] = $row;
    }

    // Encode the array to JSON and save it to the books.json file
    file_put_contents('books.json', json_encode($books, JSON_PRETTY_PRINT));
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve form data
    $title = $_POST['title'] ?? '';
    $author = $_POST['author'] ?? '';
    $publication_year = $_POST['publication_year'] ?? 0;
    $genre = $_POST['genre'] ?? '';

    // Validate form data
    if (empty($title) || empty($author) || empty($publication_year) || empty($genre)) {
        die("All fields are required.");
    }

    // Insert data into the database
    $stmt = $conn->prepare("INSERT INTO books (title, author, publication_year, genre) VALUES (?, ?, ?, ?)");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("ssis", $title, $author, $publication_year, $genre);

    if ($stmt->execute()) {
        updateJsonFile($conn); // Update the JSON file after adding the book
        echo "Book added successfully! <a href='add_book.html'>Add another book</a>";
    } else {
        die("Error adding book: " . $stmt->error);
    }
}
?>