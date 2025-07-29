<?php
include 'includes/session.php';
include 'includes/conn.php'; // Make sure to include your database connection

if(isset($_POST['id'])){
    $id = $_POST['id'];

    // Fetch application details
    $sql = "SELECT * FROM candidateapplication WHERE id = ?";
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
            // Optionally: Update the application status if you have such a column
            $update_sql = "DELETE FROM candidateapplication WHERE id = ?";
            $update_stmt = $conn->prepare($update_sql);
            $update_stmt->bind_param("i", $id);
            $update_stmt->execute();

            $_SESSION['success'] = "Application approved and candidate added successfully.";
        } else {
            $_SESSION['error'] = "Error approving application. Please try again.";
        }
    } else {
        $_SESSION['error'] = "Application not found.";
    }
} else {
    $_SESSION['error'] = "No application ID provided.";
}

header('location: applications.php');
?>
