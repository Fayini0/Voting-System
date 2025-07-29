<?php
include 'includes/session.php';
include 'includes/conn.php'; // Include your database connection file

// Enable error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Check if the decline action is requested
if (isset($_POST['action']) && $_POST['action'] === 'decline_all') {
    // Check if the connection was successful
    if ($conn) {
        // Prepare the SQL query to update all applications to declined
        $stmt = $conn->prepare("UPDATE hc_application SET status = 'declined' WHERE status != 'declined'");

        // Check if the statement was prepared successfully
        if ($stmt) {
            // Execute the statement
            if ($stmt->execute()) {
                echo json_encode(['success' => true, 'message' => 'All applications declined successfully.']);
            } else {
                // If there was an error, return an error response
                echo json_encode(['success' => false, 'message' => 'Error declining applications: ' . $stmt->error]);
            }
            // Close the statement
            $stmt->close();
        } else {
            // If the statement could not be prepared
            echo json_encode(['success' => false, 'message' => 'Error preparing statement: ' . $conn->error]);
        }
    } else {
        // Connection failed
        echo json_encode(['success' => false, 'message' => 'Database connection failed.']);
    }
} else {
    // If action is not set, return an error response
    echo json_encode(['success' => false, 'message' => 'Invalid action.']);
}

// Close the database connection
$conn->close();
?>
