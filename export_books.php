<?php
// Define the path to the Python executable and the script
$python = 'C:\\Users\\Lokesh Patra\\AppData\\Local\\Programs\\Python\\Python312\\python.exe';  // Full path to Python executable
$script = 'export_books.py';  // The Python script to be executed

// Execute the Python script and capture the output
$output = shell_exec("\"$python\" \"$script\" 2>&1"); // Ensure paths with spaces are handled properly

// Check if the script executed successfully and output the results
if ($output) {
    echo "Books and genre counts exported to books.xml successfully!";
} else {
    echo "Failed to export books to XML. Please check the server logs for more details.";
}
?>