<?php
session_start();
require 'db_config.php';

// PHP: Handle form submission and fetch data
$search_results = null;
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    // Get the search criteria from the form
    $title = $_GET['title'] ?? '';
    $author = $_GET['author'] ?? '';
    $publication_year = $_GET['publication_year'] ?? '';

    // Build the SQL query dynamically based on the user input
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

    // Execute the query and store results
    $search_results = $conn->query($query);

    // Prepare the result as an array
    $books = [];
    if ($search_results && $search_results->num_rows > 0) {
        while ($row = $search_results->fetch_assoc()) {
            $books[] = $row;
        }

        // Update the books.json file
        file_put_contents('books.json', json_encode($books, JSON_PRETTY_PRINT));

        // Update the books.xml file
        $xml = new SimpleXMLElement('<books/>');
        foreach ($books as $book) {
            $book_xml = $xml->addChild('book');
            $book_xml->addChild('title', $book['title']);
            $book_xml->addChild('author', $book['author']);
            $book_xml->addChild('publication_year', $book['publication_year']);
            $book_xml->addChild('genre', $book['genre']);
        }
        $xml->asXML('books.xml');
    }

    // Return the results as JSON for frontend use
    echo json_encode($books);
    exit();
}
?>
