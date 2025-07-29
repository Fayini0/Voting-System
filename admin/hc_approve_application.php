<?php
include 'includes/session.php';
include 'includes/conn.php'; // Make sure to include your database connection file

if(isset($_POST['id'])){
    $id = $_POST['id'];
    
    // Fetch candidate application details
    $sql = "SELECT * FROM hc_application WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        
        // Insert into candidates table
        $insert_sql = "INSERT INTO candidates (position_id, firstname, lastname, photo, platform) VALUES (?, ?, ?, ?, ?)";
        $insert_stmt = $conn->prepare($insert_sql);
        $insert_stmt->bind_param("issss", $row['position_id'], $row['firstname'], $row['lastname'], $row['photo'], $row['platform']);
        
        if($insert_stmt->execute()){
            // Optionally delete the approved application from the hc_application table
            $delete_sql = "DELETE FROM hc_application WHERE id = ?";
            $delete_stmt = $conn->prepare($delete_sql);
            $delete_stmt->bind_param("i", $id);
            $delete_stmt->execute();
            
            // Return success response
            echo json_encode(['success' => true, 'message' => 'Application approved successfully.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error approving application.']);
        }
        
        $insert_stmt->close();
        $delete_stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Application not found.']);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'No application ID provided.']);
}

$conn->close();
?>
