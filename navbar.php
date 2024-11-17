<?php
// Start the session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<nav>
    <header>
        <h1><a href="index.php">Library Management System</a></h1>
    </header>
    <ul>
        <?php if (isset($_SESSION['username'])): ?>
            <li>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</li>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="add_book.php">Add Book</a></li>
            <li><a href="search_books.html">Search Books</a></li>
            <li><a href="logout.php" onclick="return confirm('Are you sure you want to log out?');">Logout</a></li>
        <?php else: ?>
            <li><a href="login.html">Log In</a></li>
            <li><a href="register.html">Register</a></li>
        <?php endif; ?>
    </ul>
</nav>

<style>
    body {
        font-family: 'Cambria', serif;
        background-color: #f4f4f4; /* Light grey background */
        color: #333333; /* Dark text color */
        margin: 0;
        padding: 0;
    }

    nav {
        background: #2C3E50; /* Dark blue */
        color: #ffffff; /* White text */
        padding: 10px;
        text-align: center; /* Center align */
    }

    nav a {
        color: #ffffff; /* White text */
        text-decoration: none;
        margin: 0 10px;
    }

    nav ul {
        list-style-type: none;
        padding: 0;
        display: inline-block; /* Change list to inline-block */
    }

    nav ul li {
        display: inline;
    }

    nav header h1 a {
        color: #ffffff; /* White text */
        text-decoration: none;
    }

    header {
        background-color: #2C3E50; /* Dark blue */
        color: #ffffff; /* White text */
        text-align: center;
        padding: 20px 0;
        margin-bottom: 40px;
    }

    header h1 {
        font-size: 2.5rem;
        margin: 0;
    }

    main {
        text-align: center;
        padding: 30px 10px;
    }

    main h2 {
        color: #2C3E50; /* Dark blue */
        font-size: 2rem;
        margin-bottom: 30px;
    }

    .actions {
        display: flex;
        justify-content: center;
        gap: 20px;
    }

    .actions a {
        background-color: #3498db; /* Blue button */
        color: #ffffff; /* White text */
        padding: 12px 20px;
        text-decoration: none;
        border-radius: 4px;
        font-size: 1.1rem;
        transition: background-color 0.3s;
    }

    .actions a:hover {
        background-color: #2980b9; /* Darker blue on hover */
    }

    footer {
        background-color: #2C3E50; /* Dark blue */
        color: #ffffff; /* White text */
        text-align: center;
        padding: 10px;
        position: absolute;
        bottom: 0;
        width: 100%;
    }
</style>