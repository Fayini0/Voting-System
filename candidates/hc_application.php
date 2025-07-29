<?php
require_once '../includes/conn.php'; // Make sure this path is correct

// Fetch positions from the database
$sql = "SELECT * FROM positions";
$query = $conn->query($sql);
$positions = [];
while ($row = $query->fetch_assoc()) {
    $positions[] = $row; // Store positions in an array
}

// Fetch HC applications from the database (if needed)
$sql_hc_applications = "SELECT * FROM hc_application";
$query_hc_applications = $conn->query($sql_hc_applications);
$hc_applications = [];
while ($row_hc = $query_hc_applications->fetch_assoc()) {
    $hc_applications[] = $row_hc; // Store HC applications in an array
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HC Candidate Application</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8d7da; /* Light red background */
            margin: 0;
            padding: 20px;
        }
        .container {
            background-color: #ffffff;
            border-radius: 5px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 0 auto;
        }
        h3 {
            color: #721c24; /* Dark red color */
            text-align: center;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #721c24; /* Dark red color */
        }
        .form-control {
            width: 100%;
            padding: 8px;
            border: 1px solid #dc3545; /* Red border */
            border-radius: 4px;
            box-sizing: border-box;
        }
        .btn-primary {
            background-color: #dc3545; /* Red button */
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .btn-primary:hover {
            background-color: #c82333; /* Darker red on hover */
        }
        .error {
            color: #dc3545;
            font-size: 0.9rem;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h3>HC Candidate Application</h3>
        <form action="hc_process_application.php" method="POST" enctype="multipart/form-data" onsubmit="return validateForm();">

            <div class="form-group">
                <label for="firstname">First Name</label>
                <input type="text" class="form-control" id="firstname" name="firstname" required placeholder="e.g. John">
                <div id="firstnameError" class="error"></div>
            </div>
            <div class="form-group">
                <label for="lastname">Last Name</label>
                <input type="text" class="form-control" id="lastname" name="lastname" required placeholder="e.g. Doe">
                <div id="lastnameError" class="error"></div>
            </div>
            <div class="form-group">
                <label for="position">Position</label>
                <select class="form-control" id="position" name="position" required>
                    <option value="">Select a position</option>
                    <?php foreach ($positions as $position): ?>
                        <option value="<?= $position['id']; ?>"><?= $position['description']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="platform">Platform</label>
                <textarea class="form-control" id="platform" name="platform" rows="3" required placeholder="Describe your campaign platform..."></textarea>
            </div>
            <div class="form-group">
                <label for="photo">Photo</label>
                <input type="file" id="photo" name="photo" required>
            </div>
            <div class="form-group">
                <label for="average">Enter your average percentage (must be 64% or more)</label>
                <input type="number" class="form-control" id="average" name="average" required placeholder="e.g. 75">
                <div id="averageError" class="error"></div>
            </div>
            <div class="form-group">
                <label for="contest_history">Have you contested before?</label>
                <select class="form-control" id="contest_history" name="contest_history" required>
                    <option value="">Select your contest history</option>
                    <option value="1">1st Time</option>
                    <option value="2">2nd Time</option>
                </select>
            </div>
            <div class="form-group">
                <label for="training">Are you willing to attend 2 weeks of training?</label>
                <select class="form-control" id="training" name="training_attendance" required>
                    <option value="">Select an option</option>
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit Application</button>
        </form>
    <!-- Back Button -->
    <button onclick="window.location.href='../index.php';" class="btn btn-secondary" style="margin-top: 15px;">Back</button>
    </div>

    <script>
    function validateForm() {
        const firstname = document.getElementById('firstname').value;
        const lastname = document.getElementById('lastname').value;
        const average = document.getElementById('average').value;
        const firstnameError = document.getElementById('firstnameError');
        const lastnameError = document.getElementById('lastnameError');
        const averageError = document.getElementById('averageError');
        let isValid = true;

        firstnameError.textContent = '';
        lastnameError.textContent = '';
        averageError.textContent = '';

        if (/\d/.test(firstname)) {
            firstnameError.textContent = "First name cannot contain a number";
            isValid = false;
        }

        if (/\d/.test(lastname)) {
            lastnameError.textContent = "Last name cannot contain a number";
            isValid = false;
        }

        if (average <= 64 || average >= 100) {
            averageError.textContent = "You Don't Qualify Your Average is less than 64";
            isValid = false;
        }

        return isValid;
    }
    </script>
</body>
</html>
