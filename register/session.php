<?php
// Check if session is already started
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Start the session only if it hasn't been started yet
}

// Database connection settings
$servername = "localhost"; // Change this if your database server is different
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "votesystem"; // Change this to your actual database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// You may also want to define a function for error handling
function handleError($message) {
    $_SESSION['error'] = $message;
    header('Location: register.php');
    exit();
}
?>
