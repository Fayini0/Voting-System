<?php
include 'includes/session.php';

if(isset($_POST['voters'])){
    $voters = $_POST['voters'];
    $restored = true;

    // Insert each deleted voter back into the database
    foreach($voters as $voter){
        $sql = "INSERT INTO voters (lastname, firstname, email, voters_id, photo) VALUES ('".$voter['lastname']."', '".$voter['firstname']."', '".$voter['email']."', '".$voter['voters_id']."', '".$voter['photo']."')";
        if(!$conn->query($sql)){
            $restored = false;
        }
    }

    if($restored){
        echo 'success';
    }
    else{
        echo 'error';
    }
}
else{
    echo 'error';
}
?>
