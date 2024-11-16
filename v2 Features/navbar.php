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
    nav {
        background: #333;
        color: #fff;
        padding: 10px;
    }
    nav a {
        color: #fff;
        text-decoration: none;
        margin: 0 10px;
    }
    nav ul {
        list-style-type: none;
        padding: 0;
    }
    nav ul li {
        display: inline;
    }
    nav header h1 a {
        color: #fff;
        text-decoration: none;
    }
</style>