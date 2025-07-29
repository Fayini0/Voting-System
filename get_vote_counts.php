<?php
include 'includes/session.php';
include 'includes/conn.php';

// Query to get vote counts along with candidate names and their positions
$query = "
    SELECT p.description AS position, c.firstname, c.lastname, COUNT(v.candidate_id) AS votes 
    FROM votes v
    JOIN candidates c ON v.candidate_id = c.id 
    JOIN positions p ON c.position_id = p.id 
    GROUP BY p.id, v.candidate_id
    ORDER BY p.priority ASC, votes DESC
";

$result = $conn->query($query);

if (!$result) {
    // Handle the SQL error
    echo json_encode(["error" => "SQL Error: " . $conn->error]);
    exit();
}

$voteCounts = [];
while ($row = $result->fetch_assoc()) {
    $position = $row['position'];
    $candidateName = $row['firstname'] . ' ' . $row['lastname'];
    $votes = $row['votes'];

    // Organize data by position
    if (!isset($voteCounts[$position])) {
        $voteCounts[$position] = [];
    }
    $voteCounts[$position][$candidateName] = $votes;
}

echo json_encode($voteCounts);

?>