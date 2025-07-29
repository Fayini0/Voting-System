<?php
include 'includes/session.php';

// Enable error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Check if the decline action is requested
if (isset($_POST['id'])) {
    // Database connection
    include 'includes/conn.php';
    
    $id = $_POST['id'];
    
    // Prepare the SQL statement to delete the application
    $sql = "DELETE FROM candidateapplication WHERE id = ?";
    
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $id);
        
        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Application declined (deleted) successfully.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error declining (deleting) application: ' . $conn->error]);
        }
        
        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to prepare the SQL statement.']);
    }
    
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid action.']);
}

// Close the database connection
$conn->close();
?>
