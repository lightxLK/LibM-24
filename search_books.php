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
    $title = $_GET['title'] ?? '';
    $author = $_GET['author'] ?? '';
    $publication_year = $_GET['publication_year'] ?? '';

    $query = "SELECT * FROM books WHERE 1=1";
    if ($title) {
        $query .= " AND title LIKE '%" . $conn->real_escape_string($title) . "%'";
    }
    if ($author) {
        $query .= " AND author LIKE '%" . $conn->real_escape_string($author) . "%'";
    }
    if ($publication_year) {
        $query .= " AND publication_year = " . (int)$publication_year;
    }

    $search_results = $conn->query($query);
    $books = [];

    if ($search_results && $search_results->num_rows > 0) {
        while ($row = $search_results->fetch_assoc()) {
            $books[] = $row;
        }
        file_put_contents('books.json', json_encode($books, JSON_PRETTY_PRINT));
    }

    header('Content-Type: application/json');
    echo json_encode($books);
    exit;
}