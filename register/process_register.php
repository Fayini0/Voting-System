<?php

include 'session.php';
require '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// session_start();

if (isset($_POST['register'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $_POST['email'];
    $filename = $_FILES['photo']['name'];

    echo "Email received: " . $email . "<br>";

    if (preg_match('/[0-9]/', $firstname) || preg_match('/[0-9]/', $lastname)) {
        $_SESSION['error'] = 'Name and Surname cannot contain numbers.';
        header('location: register.php');
        exit();
    }

    // Validate email (removed SPU-specific check)
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = 'Invalid email format. Please enter a valid email address.';
        header('location: register.php');
        exit();
    }

    // Check for duplicate email
    $checkEmailQuery = "SELECT * FROM voters WHERE email = '$email'";
    $result = $conn->query($checkEmailQuery);

    if ($result->num_rows > 0) {
        $_SESSION['error'] = 'This email is already registered. Please use a different email.';
        header('location: register.php');
        exit();
    }

    if (!empty($filename)) {
        move_uploaded_file($_FILES['photo']['tmp_name'], '../images/' . $filename);
    }

    // Generate voters ID
    $set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $voter = substr(str_shuffle($set), 0, 15);

    $sql = "INSERT INTO voters (voters_id, password, firstname, lastname, email, photo) VALUES ('$voter', '$password', '$firstname', '$lastname', '$email', '$filename')";

    if ($conn->query($sql)) {
        // Email sending logic
        $mail = new PHPMailer();
        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'fayiinfika@gmail.com'; // Replace with your email
            $mail->Password   = 'eezdkehtneiwyqwy';     // Replace with your email password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            // Recipients
            $mail->setFrom('fayiinfika@gmail.com', 'Team SPUEVOTEHUB'); // Replace with your email and name
            $mail->addAddress($email, "$firstname $lastname");

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Your Voter ID';
            $mail->Body    = 'Your voter ID is: <b>' . $voter .'<br>' . ' DO NOT REPLY.'. '</b>';
            $mail->AltBody = 'Your voter ID is: ' . $voter. 'USE THIS VOTERS ID NEXT TIME YOU LOG IN -NB: DO NOT REPLY TO THIS EMAIL.';

            $mail->send();
            $_SESSION['success'] = 'Registration successful and email sent';
            
            echo "<script>
                    alert('Check your email or contact admin if you entered a wrong email');
                    setTimeout(function() {
                        window.location.href = '../login.php';
                    }, 2000); // Redirect after 2 seconds
                  </script>";
            exit();
        } catch (Exception $e) {
            $_SESSION['error'] = 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
        }
    } else {
        $_SESSION['error'] = $conn->error;
    }
} else {
    //$_SESSION['error'] = 'Input voter credentials first';
}

header('location: register.php');
?>