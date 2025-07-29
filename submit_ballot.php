<?php
include 'includes/session.php';
include 'includes/slugify.php';

if (isset($_POST['vote'])) {
    if (count($_POST) == 1) {
        $_SESSION['error'][] = 'Please vote for at least one candidate';
    } else {
        $_SESSION['post'] = $_POST;
        $sql = "SELECT * FROM positions";
        $query = $conn->query($sql);
        $error = false;
        $sql_array = array();
        
        while ($row = $query->fetch_assoc()) {
            $position = slugify($row['description']);
            $pos_id = $row['id'];
            
            if (isset($_POST[$position])) {
                if ($row['max_vote'] > 1) {
                    if (count($_POST[$position]) > $row['max_vote']) {
                        $error = true;
                        $_SESSION['error'][] = 'You can only choose ' . $row['max_vote'] . ' candidates for ' . $row['description'];
                    } else {
                        foreach ($_POST[$position] as $key => $values) {
                            // Prepare statement for inserting votes
                            $stmt = $conn->prepare("INSERT INTO votes (voters_id, candidate_id, position_id) VALUES (?, ?, ?)");
                            $stmt->bind_param("iii", $voter['id'], $values, $pos_id);
                            $sql_array[] = $stmt;
                        }
                    }
                } else {
                    $candidate = $_POST[$position];
                    // Prepare statement for inserting votes
                    $stmt = $conn->prepare("INSERT INTO votes (voters_id, candidate_id, position_id) VALUES (?, ?, ?)");
                    $stmt->bind_param("iii", $voter['id'], $candidate, $pos_id);
                    $sql_array[] = $stmt;
                }
            }
        }

        if (!$error) {
            foreach ($sql_array as $stmt) {
                $stmt->execute(); // Execute the prepared statement
                $stmt->close(); // Close the statement
            }

            unset($_SESSION['post']);
            $_SESSION['success'] = 'Ballot Submitted';
        }
    }
} else {
    $_SESSION['error'][] = 'Select candidates to vote for first';
}

header('location: home.php');
?>
