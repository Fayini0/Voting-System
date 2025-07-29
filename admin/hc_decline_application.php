<?php
include 'includes/session.php'; // Include your session file
include 'includes/conn.php'; // Include your database connection

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Prepare to delete the application from the hc_application table
    $sql = "DELETE FROM hc_application WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Return success response
        echo json_encode(['success' => true, 'message' => 'Application declined successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error declining application.']);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'No application ID provided.']);
}

$conn->close();
?>
