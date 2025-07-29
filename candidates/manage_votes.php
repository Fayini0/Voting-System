<?php
// index.php

session_start();

// Database connection
$db = new mysqli('localhost', 'root', '', 'votesystem');
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}
// Simulating admin control with a configuration file
// In a real-world scenario, you might want to use a database instead
$config = json_decode(file_get_contents('config.json'), true);

 //Handle admin login
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['admin_login'])) {
    $username = $db->real_escape_string($_POST['username']);
    $password = $_POST['password'];

    $result = $db->query("SELECT * FROM admin WHERE username = '$username'");
    if ($result->num_rows == 1) {
        $admin = $result->fetch_assoc();
        if (password_verify($password, $admin['password'])) {
            $_SESSION['admin_logged_in'] = true;
            $message = "Admin logged in successfully.";
        } else {
            $error = "Invalid username or password.";
        }
    } else {
        $error = "Invalid username or password.";
    }
}
// Function to check if a button should be displayed
function isButtonEnabled($buttonKey) {
    global $config;
    return isset($config[$buttonKey]) && $config[$buttonKey];
}
// Handle admin logout
if (isset($_GET['logout'])) {
    unset($_SESSION['admin_logged_in']);
    $message = "Admin logged out successfully.";
}

// Handle form submission for settings
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    $config = [
        'src_button_enabled' => isset($_POST['src_button_enabled']),
        'hc_button_enabled' => isset($_POST['hc_button_enabled']),
    ];
    
    // Save the config
    file_put_contents('config.json', json_encode($config));
    $message = "Settings updated successfully.";
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Candidates Information</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            padding: 20px;
            max-width: 600px;
            width: 100%;
            position: relative;
        }
        h1, h2 {
            color: #333;
            text-align: center;
        }
        .info-box {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 15px;
            margin-bottom: 20px;
        }
        ul {
            padding-left: 20px;
        }
        li {
            margin-bottom: 10px;
        }
        .button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            text-align: center;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s;
        }
        .button:hover {
            background-color: #0056b3;
        }
        .button.disabled {
            background-color: #cccccc;
            cursor: not-allowed;
        }
        .button.disabled:hover {
            background-color: #cccccc;
        }
        .back-button, .admin-button {
            position: absolute;
            top: 10px;
            background-color: #f0f0f0;
            color: #333;
            border: none;
            padding: 8px 15px;
            border-radius: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            font-size: 14px;
        }
        .back-button {
            left: 10px;
        }
        .admin-button {
            right: 10px;
        }
        .back-button:hover, .admin-button:hover {
            background-color: #e0e0e0;
        }
        .back-button::before {
            content: '←';
            margin-right: 5px;
            font-size: 18px;
        }
        /* Popup styles */
        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.3);
            z-index: 1000;
        }
        .popup-content {
            max-width: 300px;
        }
        .popup-buttons {
            text-align: right;
            margin-top: 20px;
        }
        .popup-buttons button {
            padding: 8px 15px;
            margin-left: 10px;
            cursor: pointer;
        }
        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
            z-index: 999;
        }
        .error {
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href= "../admin/home.php" class="back-button" onclick="goBack()">Back</a>
        <!--<button class="back-button" onclick="goBack()">Back</button>-->
        <button class="admin-button" onclick="showAdminPopup()">Admin</button>
        <h1>Candidates Information</h1>
        
        <div class="info-box">
            <h2>Student Representative Council:</h2>
            <ul>
                <li>Must be contesting for 1st or 2nd time</li>
                <li>Must average 64% + every year</li>
                <li>Must be in 2nd year or higher to apply</li>
            </ul>
            <?php if (isButtonEnabled('src_button_enabled')): ?>
                <a href="#" class="button">Manage SRC Candidates</a>
            <?php else: ?>
                <span class="button disabled">SRC Applications Closed</span>
            <?php endif; ?>
        </div>
        
        <div class="info-box">
            <h2>House Committee:</h2>
            <ul>
                <li>Must be contesting for 1st or 2nd time</li>
                <li>Must average 64% + every year</li>
                <li>Willing to attend 2 weeks of Training</li>
            </ul>
            <?php if (isButtonEnabled('hc_button_enabled')): ?>
                <a href="#" class="button">Manage HC Candidates</a>
            <?php else: ?>
                <span class="button disabled">HC Applications Closed</span>
            <?php endif; ?>
        </div>
    </div>

    <!-- Admin Popup -->
    <div id="adminPopup" class="popup">
        <div class="popup-content">
            <h2>Admin Control Panel</h2>
            <?php if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true): ?>
                <form id="settingsForm" method="POST">
                    <label>
                        <input type="checkbox" name="src_button_enabled" <?php echo $config['src_button_enabled'] ? 'checked' : ''; ?>>
                        Enable SRC Application Button
                    </label>
                    <label>
                        <input type="checkbox" name="hc_button_enabled" <?php echo $config['hc_button_enabled'] ? 'checked' : ''; ?>>
                        Enable HC Application Button
                    </label>
                    <div class="popup-buttons">
                        <button type="button" onclick="closeAdminPopup()">Cancel</button>
                        <button type="submit">Save Settings</button>
                    </div>
                </form>
            <?php else: ?>
                <form method="POST">
                    <input type="text" name="username" placeholder="Username" required><br>
                    <input type="password" name="password" placeholder="Password" required><br>
                    <div class="popup-buttons">
                        <button type="button" onclick="closeAdminPopup()">Cancel</button>
                        <button type="submit" name="admin_login">Login</button>
                    </div>
                </form>
            <?php endif; ?>
            <?php if (isset($error)): ?>
                <p class="error"><?php echo $error; ?></p>
            <?php endif; ?>
        </div>
    </div>

    <div id="overlay" class="overlay"></div>

    <script>
        function goBack() {
            window.history.back();
        }

        function showAdminPopup() {
            document.getElementById('adminPopup').style.display = 'block';
            document.getElementById('overlay').style.display = 'block';
        }

        function closeAdminPopup() {
            document.getElementById('adminPopup').style.display = 'none';
            document.getElementById('overlay').style.display = 'none';
        }

        // Close popup when clicking outside
        window.onclick = function(event) {
            if (event.target == document.getElementById('overlay')) {
                closeAdminPopup();
            }
        }

        <?php if (isset($message)): ?>
        alert("<?php echo $message; ?>");
        <?php endif; ?>
    </script>
</body>
</html>