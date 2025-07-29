<?php
require 'vendor/autoload.php'; // Make sure this path is correct

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Create an instance of PHPMailer
$mail = new PHPMailer();

echo 'PHPMailer is installed successfully!';
?>
