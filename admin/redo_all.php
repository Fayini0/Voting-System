<?php
// Include the database connection
include 'includes/conn.php';

// Start the session (if not already started)
session_start();

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if the action is 'redo_all'
    if (isset($_POST['action']) && $_POST['action'] == 'redo_all') {
        try {
            // Start a transaction
            $conn->begin_transaction();

            // Option 1: Reset all positions to default values
            // This assumes you have default values for each column
            $sql = "UPDATE positions SET description = 'Default Position', max_vote = 1, priority = 0";
            $conn->query($sql);

            // Option 2: Restore from a backup table (uncomment if you have a backup table)
            // $sql = "TRUNCATE TABLE positions";
            // $conn->query($sql);
            // $sql = "INSERT INTO positions SELECT * FROM positions_backup";
            // $conn->query($sql);

            // Option 3: Delete all positions and reset auto-increment
            // $sql = "TRUNCATE TABLE positions";
            // $conn->query($sql);

            // Commit the transaction
            $conn->commit();

            // Set success message
            $_SESSION['success'] = "All positions have been reset successfully.";

            // Send a success response
            echo json_encode(['success' => true, 'message' => 'All positions have been reset successfully.']);
        } catch (Exception $e) {
            // An error occurred; rollback the transaction
            $conn->rollback();

            // Set error message
            $_SESSION['error'] = "An error occurred while resetting positions: " . $e->getMessage();

            // Send an error response
            echo json_encode(['success' => false, 'message' => 'An error occurred while resetting positions.']);
        }
    } else {
        // Invalid action
        echo json_encode(['success' => false, 'message' => 'Invalid action.']);
    }
} else {
    // Not a POST request
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}

// Close the database connection
$conn->close();
?>