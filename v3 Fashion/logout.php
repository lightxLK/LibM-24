<?php
session_start();
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    session_unset();
    session_destroy();
    echo "<script>
        alert('$username logged out successfully!');
        window.location.href = 'index.php';
    </script>";
} else {
    header("Location: index.php");
    exit;
}
?>
