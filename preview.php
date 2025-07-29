<?php
include 'includes/session.php';
include 'includes/slugify.php';

$output = array('error' => false, 'list' => array());

$sql = "SELECT * FROM positions";
$query = $conn->query($sql);

while($row = $query->fetch_assoc()){
    $position = slugify($row['description']);
    $pos_id = $row['id'];
    if(isset($_POST[$position])){
        if($row['max_vote'] > 1){
            if(count($_POST[$position]) > $row['max_vote']){
                $output['error'] = true;
                $output['message'] = 'You can only choose '.$row['max_vote'].' candidates for '.$row['description'];
            }
            else{
                foreach($_POST[$position] as $key => $values){
                    $sql = "SELECT * FROM candidates WHERE id = '$values'";
                    $cmquery = $conn->query($sql);
                    $cmrow = $cmquery->fetch_assoc();
                    $output['list'][$row['description']][] = $cmrow['firstname'].' '.$cmrow['lastname'];
                }
            }
        }
        else{
            $candidate = $_POST[$position];
            $sql = "SELECT * FROM candidates WHERE id = '$candidate'";
            $csquery = $conn->query($sql);
            $csrow = $csquery->fetch_assoc();
            $output['list'][$row['description']] = $csrow['firstname'].' '.$csrow['lastname'];
        }
    }
}

// Add the suggestion to the output
if(isset($_POST['overall_suggestion'])) {
    $output['suggestion'] = $_POST['overall_suggestion'];
}

echo json_encode($output);
?>