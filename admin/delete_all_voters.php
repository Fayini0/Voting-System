<?php
include 'includes/session.php';

if(isset($_POST['action']) && $_POST['action'] == 'delete_all'){
    $sql = "DELETE FROM voters"; // SQL query to delete all records
    if($conn->query($sql)){
        echo 'success'; // Return success if deletion was successful
        $_SESSION['success'] = 'All voters deleted successfully';
    }
    else{
        echo 'error'; // Return error if deletion failed
        $_SESSION['error'] = 'An error occurred while trying to delete all voters';
    }
}
else{
    echo 'invalid'; // Return invalid if the action is not set correctly
    $_SESSION['error'] = 'Invalid request';
}
?>
