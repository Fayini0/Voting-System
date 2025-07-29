<?php
    include 'includes/session.php';
    include 'includes/conn.php';

    if(isset($_POST['add'])){
        // Get form inputs and escape special characters
        $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
        $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
        $position = mysqli_real_escape_string($conn, $_POST['position']);
        $platform = mysqli_real_escape_string($conn, $_POST['platform']);

        // Handle file upload
        $filename = '';
        if(!empty($_FILES['photo']['name'])){
            $filename = $_FILES['photo']['name'];
            $target_dir = '../images/';
            $target_file = $target_dir . basename($filename);

            // Move uploaded file
            if(!move_uploaded_file($_FILES['photo']['tmp_name'], $target_file)){
                $_SESSION['error'] = 'File upload failed';
                header('location: candidates.php');
                exit();
            }
        }

        // Insert into the database
        $sql = "INSERT INTO candidates (position_id, firstname, lastname, photo, platform) 
                VALUES ('$position', '$firstname', '$lastname', '$filename', '$platform')";
        if($conn->query($sql)){
            $_SESSION['success'] = 'Candidate added successfully';
        } else {
            $_SESSION['error'] = 'Database error: ' . $conn->error;
        }
    } else {
        $_SESSION['error'] = 'Fill up add form first';
    }

    header('location: candidates.php');
?>
