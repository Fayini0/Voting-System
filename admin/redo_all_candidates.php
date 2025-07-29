<?php
include 'includes/session.php';

if(isset($_POST['action']) && $_POST['action'] == 'redo_all'){
    // Start transaction
    $conn->begin_transaction();

    try {
        // First, backup current candidates to a temporary table
        $conn->query("CREATE TEMPORARY TABLE temp_candidates SELECT * FROM candidates");

        // Delete all current candidates
        $conn->query("DELETE FROM candidates");

        // Reset auto-increment
        $conn->query("ALTER TABLE candidates AUTO_INCREMENT = 1");

        // Restore candidates from temporary table with default values
        $sql = "INSERT INTO candidates (position_id, firstname, lastname, photo, platform) 
                SELECT position_id, firstname, lastname, '', 'Default platform' 
                FROM temp_candidates";
        $conn->query($sql);

        // Drop temporary table
        $conn->query("DROP TEMPORARY TABLE temp_candidates");

        // Commit transaction
        $conn->commit();

        $_SESSION['success'] = 'All candidates have been reset successfully';
        echo json_encode(array('success' => true, 'message' => 'All candidates have been reset successfully.'));
    } catch (Exception $e) {
        // Rollback transaction on error
        $conn->rollback();
        $_SESSION['error'] = $e->getMessage();
        echo json_encode(array('success' => false, 'message' => $e->getMessage()));
    }
} else {
    $_SESSION['error'] = 'Invalid action';
    echo json_encode(array('success' => false, 'message' => 'Invalid action.'));
}

$conn->close();
?>