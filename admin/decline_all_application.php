<?php
include 'includes/session.php';

// Enable error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Check if the decline action is requested
if (isset($_POST['action']) && $_POST['action'] === 'decline_all') {
    // Database connection
    include 'includes/conn.php';

    // SQL statement to delete all records from the candidateapplication table
    $sql = "DELETE FROM candidateapplication";

    if ($conn->query($sql) === TRUE) {
        // Return a success response if the deletion is successful
        echo json_encode(['success' => true, 'message' => 'All applications declined (deleted) successfully.']);
    } else {
        // Return an error response if the deletion fails
        echo json_encode(['success' => false, 'message' => 'Error declining (deleting) applications: ' . $conn->error]);
    }

    // Close the database connection
    $conn->close();
} else {
    // Return an error response if the action is not set
    echo json_encode(['success' => false, 'message' => 'Invalid action.']);
}
?>
