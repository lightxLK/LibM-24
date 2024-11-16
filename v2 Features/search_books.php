<?php
session_start();
require 'db_config.php';

// Redirect if the user is not logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit;
}

// Handle search request
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    // Get search parameters from the URL (query string)
    $title = $_GET['title'] ?? '';
    $author = $_GET['author'] ?? '';
    $publication_year = $_GET['publication_year'] ?? '';

    // Build the SQL query dynamically based on the user input
    $query = "SELECT * FROM books WHERE 1=1"; // 1=1 to ensure the query is always valid
    if ($title) {
        $query .= " AND title LIKE '%" . $conn->real_escape_string($title) . "%'";
    }
    if ($author) {
        $query .= " AND author LIKE '%" . $conn->real_escape_string($author) . "%'";
    }
    if ($publication_year) {
        $query .= " AND publication_year = " . (int)$publication_year;
    }

    // Execute the query and store the results
    $search_results = $conn->query($query);
    $books = [];

    // Fetch the results if available
    if ($search_results && $search_results->num_rows > 0) {
        while ($row = $search_results->fetch_assoc()) {
            $books[] = $row;
        }

        // Optionally, update books.json file if needed (store the results in a file)
        file_put_contents('books.json', json_encode($books, JSON_PRETTY_PRINT));
    }

    // Set the content type to JSON and return the results as JSON
    header('Content-Type: application/json');
    echo json_encode($books);  // Send the results back to the client in JSON format
    exit;
}
