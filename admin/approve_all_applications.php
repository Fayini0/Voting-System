<?php
include 'includes/session.php'; // Include your session file
include 'includes/conn.php'; // Include your database connection

if (isset($_POST['action']) && $_POST['action'] == 'approve_all') {
    // Prepare to fetch all pending applications
    $sql = "SELECT * FROM candidateapplication";
    $result = $conn->query($sql);

    // Check if there are any applications to approve
    if ($result->num_rows > 0) {
        // Loop through each application
        while ($row = $result->fetch_assoc()) {
            // Prepare to insert into candidates table
            $insert_sql = "INSERT INTO candidates (position_id, firstname, lastname, photo, platform) VALUES (?, ?, ?, ?, ?)";
            $insert_stmt = $conn->prepare($insert_sql);

            // Check if the prepare was successful
            if ($insert_stmt === false) {
                error_log('MySQL prepare error: ' . $conn->error);
                echo json_encode(['success' => false, 'message' => 'Database error while preparing insert statement.']);
                exit;
            }

            // Bind the parameters
            $insert_stmt->bind_param("issss", $row['position_id'], $row['firstname'], $row['lastname'], $row['photo'], $row['platform']);

            // Execute the insert statement
            if ($insert_stmt->execute()) {
                // Optionally delete the approved application from candidateapplication table
                $delete_sql = "DELETE FROM candidateapplication WHERE id = ?";
                $delete_stmt = $conn->prepare($delete_sql);

                // Check if delete prepare was successful
                if ($delete_stmt === false) {
                    error_log('MySQL prepare error: ' . $conn->error);
                    echo json_encode(['success' => false, 'message' => 'Database error while preparing delete statement.']);
                    exit;
                }

                // Bind and execute the delete statement
                $delete_stmt->bind_param("i", $row['id']);
                $delete_stmt->execute();
            } else {
                // Handle insert error
                error_log('Insert error: ' . $insert_stmt->error);
                echo json_encode(['success' => false, 'message' => 'Error inserting candidate: ' . $insert_stmt->error]);
                exit;
            }
        }
        // Success response
        echo json_encode(['success' => true, 'message' => 'All applications approved successfully.']);
    } else {
        // No applications found
        echo json_encode(['success' => false, 'message' => 'No applications found.']);
    }
} else {
    // Invalid request
    echo json_encode(['success' => false, 'message' => 'Invalid request.']);
}
?>
