<?php
require_once '../includes/conn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $position = $_POST['position'];
    $platform = $_POST['platform'];
    $average = $_POST['average'];
    $year = $_POST['year'];
    $contest_history = $_POST['contest_history'];

    // Debugging: Check the received values
    var_dump($average);
    var_dump($year);

    // Validate year input
    if (!in_array($year, [1, 2, 3, 4])) {
        die("Invalid year selected. Please go back and select a valid year.");
    }

    // Validate average input
    if (!is_numeric($average) || $average < 0 || $average > 100) {
        die("Invalid average value. Please enter a number between 0 and 100.");
    }
    $average = (float)$average; // Ensure average is treated as a float

    // Handle file upload
    $filename = $_FILES['photo']['name'];
    $target_dir = "../images/"; // Make sure this directory exists and is writable
    $target_file = $target_dir . basename($filename);

    if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
        // Prepare SQL statement for candidate application
        $stmt = $conn->prepare("INSERT INTO candidateapplication (firstname, lastname, position_id, platform, average, year, contest_history, photo) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssisdiss", $firstname, $lastname, $position, $platform, $average, $year, $contest_history, $filename);

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
        } else {
            $_SESSION['error'] = "Error: " . $stmt->error;
            header('location: candidates.php'); // Redirect back to the form page on error
        }
        $stmt->close();
    } else {
        $_SESSION['error'] = "Sorry, there was an error uploading your file.";
        header('location: candidates.php'); // Redirect back to the form page on error
    }
} else {
    $_SESSION['error'] = 'Fill up application form first';
    header('location: candidates.php');
}

$conn->close();
?>
