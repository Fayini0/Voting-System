<?php
require_once '../includes/conn.php'; // Make sure this path is correct

// Fetch positions from the database
$sql = "SELECT * FROM positions";
$query = $conn->query($sql);
$positions = [];
while ($row = $query->fetch_assoc()) {
    $positions[] = $row; // Store positions in an array
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SRC Candidate Application</title>
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
        <h3>SRC Candidate Application</h3>
        <form method="POST" action="process_application.php" enctype="multipart/form-data" onsubmit="return validateForm()">
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
                <label for="platform">Manifesto</label>
                <textarea class="form-control" id="platform" name="platform" rows="3" required placeholder="Describe your campaign platform..."></textarea>
            </div>
            <div class="form-group">
                <label for="photo">Photo</label>
                <input type="file" id="photo" name="photo" required>
            </div>
            <div class="form-group">
                <label for="average">Do you average 64% or more every year? (Enter your average)</label>
                <input type="number" class="form-control" id="average" name="average" required placeholder="e.g. 75" min="1" max="100">
                <div id="averageError" class="error"></div>
            </div>
            <div class="form-group">
                <label for="year">Are you in 2nd year or higher?</label>
                <select class="form-control" id="year" name="year" required>
                    <option value="">Select your year</option>
                    <option value="1">1st Year</option>
                    <option value="2">2nd Year</option>
                    <option value="3">3rd Year</option>
                    <option value="4">4th Year</option>
                </select>
            </div>
            <div class="form-group">
                <label for="contest_history">Have you contested for 1st or 2nd time?</label>
                <select class="form-control" id="contest_history" name="contest_history" required>
                    <option value="">Select your contest history</option>
                    <option value="1">1st</option>
                    <option value="2">2nd</option>
                    <option value="3">3rd</option>
                    <option value="4">4th+</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit Application</button>
        </form>
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

        if (average < 1 || average > 100) {
            averageError.textContent = "Please enter a number between 1 and 100";
            isValid = false;
        }

        return isValid;
    }
    function confirmSubmission() {
        return confirm("Are you sure you want to submit the application?");
    }
    </script>
</body>
</html>
