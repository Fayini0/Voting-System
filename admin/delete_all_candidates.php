<?php
include 'includes/session.php';

if(isset($_POST['action']) && $_POST['action'] == 'delete_all'){
    $sql = "DELETE FROM candidates";
    if($conn->query($sql)){
        $_SESSION['success'] = 'All candidates deleted successfully';
    }
    else{
        $_SESSION['error'] = 'An error occurred while trying to delete all candidates';
    }
}
else{
    $_SESSION['error'] = 'Invalid request';
}
?>
