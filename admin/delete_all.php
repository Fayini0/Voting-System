<?php
include 'includes/session.php';

if(isset($_POST['action']) && $_POST['action'] == 'delete_all'){
  $sql = "DELETE FROM positions";
  if($conn->query($sql)){
    $_SESSION['success'] = 'All data deleted successfully';
  }
  else{
    $_SESSION['error'] = 'Something went wrong while deleting all data';
  }
}

header('location: positions.php');
?>
