<?php
// set_deadline.php

// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database connection
$conn = new mysqli('localhost', 'root', '', 'votesystem');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
 // Make sure this file correctly connects to your database

 $deadline = $_POST['deadline'];

 // Check if there is already a row in the settings table
 $result = $conn->query("SELECT * FROM voting_deadlines WHERE id = 1");
 
 if ($result->num_rows > 0) {
     // Update the existing row
     $sql = "UPDATE voting_deadlines SET deadline = ? WHERE id = 1";
     $stmt = $conn->prepare($sql);
     $stmt->bind_param("s", $deadline);
 } else {
     // Insert a new row
     $sql = "INSERT INTO voting_deadlines (id, deadline) VALUES (1, ?)";
     $stmt = $conn->prepare($sql);
     $stmt->bind_param("s", $deadline);
 }
 
 // Execute the query
 if ($stmt->execute()) {
     echo "Deadline updated successfully.";
 } else {
     echo "Error updating the deadline.";
 }
 $conn->commit();

?>
