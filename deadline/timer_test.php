<?php

// Fetch the deadline from the database
$sql = "SELECT deadline FROM voting_deadlines LIMIT 1"; // Adjust your query as needed
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of the first row
    $row = $result->fetch_assoc();
    $deadline = $row['deadline'];
} else {
    // If no deadline is found, set a default (optional)
    $deadline = 'Updating...'; // Change this to a suitable default or error handling
}

// Note: Don't close the connection here if you'll use it later
// $conn->close(); // Remove this line if you need to use $conn later

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Countdown Timer</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function(){
            updateTimer(); 
            setInterval(updateTimer, 1000); 
        });

        function updateTimer() {
            console.log('Updating timer'); 
            var deadline = new Date(document.getElementById('timer').dataset.deadline).getTime();
            var now = new Date().getTime();
            var distance = deadline - now;

            if (distance < 0) {
                document.getElementById('timer').innerHTML = "VOTING CLOSED";
            } else {
                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                document.getElementById('timer').innerHTML = days + "d " + hours + "h " + minutes + "m " + seconds + "s ";
            }
        }
    </script>
</head>
<body>
    <div id="timer" data-deadline="<?php echo $deadline; ?>">Loading...</div>
</body>
</html>


