<?php
session_start();
require_once '../includes/conn.php';

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    $_SESSION['error'] = 'Fill up application form first';
    header('location: hc_application.php');
    exit;
}

$firstname = $_POST['firstname'] ?? '';
$lastname = $_POST['lastname'] ?? '';
$position_id = $_POST['position'] ?? '';
$platform = $_POST['platform'] ?? '';
$average = $_POST['average'] ?? '';
$contest_history = $_POST['contest_history'] ?? '';
$training_attendance = $_POST['training_attendance'] ?? '';

// Validate input
if (empty($firstname) || empty($lastname) || empty($position_id) || empty($platform) || empty($average) || empty($contest_history) ||  empty($training_attendance)) {

    $_SESSION['error'] = "All fields are required.";
    header('location: hc_application.php');
    exit;
}

// Validate average
if (!is_numeric($average) || $average <= 64) {
    $_SESSION['error'] = "You don't meet the requirements (average must be 64% or higher).";
    header('location: hc_application.php');
    exit;
}

// Handle file upload
$filename = null;
if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
    $filename = $_FILES['photo']['name'];
    $target_dir = "../images/";
    $target_file = $target_dir . basename($filename);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Perform file checks (type, size, etc.) here...
    // (Code for file checks omitted for brevity, but should be included)

    if (!move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
        $_SESSION['error'] = "Sorry, there was an error uploading your file.";
        header('location: hc_application.php');
        exit;
    }
} else {
    $_SESSION['error'] = "No file was uploaded or there was an upload error.";
    header('location: hc_application.php');
    exit;
}

// Database operation
try {
    // Prepare SQL statement for hc_application
    $stmt = $conn->prepare("INSERT INTO hc_application (firstname, lastname, position_id, platform, average, contest_history, photo, training_attendance) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssississ", $firstname, $lastname, $position_id, $platform, $average, $contest_history, $filename, $training_attendance);

    
        // Execute and check for success
        if ($stmt->execute()) {
            $_SESSION['success'] = 'Application submitted successfully!';
            
            // HTML for redirect
            echo "
            <!DOCTYPE html>
            <html lang='en'>
            <head>
                <meta charset='UTF-8'>
                <meta http-equiv='refresh' content='3;url=../login.php'> 
                <title>Application Submitted</title>
                <style>
                    body { font-family: Arial, sans-serif; text-align: center; padding-top: 50px; }
                    .message { color: red; }
                </style>
            </head>
            <body>
                <h1 class='message'>{$_SESSION['success']}</h1>
                <p>You will be redirected to the login page in 3 seconds...</p>
            </body>
            </html>
            ";
    // Execute and check for success
    } else {
        throw new Exception("Error: " . $stmt->error);
    }
} catch (Exception $e) {
    $_SESSION['error'] = $e->getMessage();
    header('location: hc_application.php');
} finally {
    // Close the statement and connection
    if (isset($stmt)) {
        $stmt->close();
    }
    if (isset($conn)) {
        $conn->close();
    }
    exit;
}
?>