<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Register Voter</title>
    </head>
    <body>
        <h2>Register Voter</h2>
        <form action="register.php" method="POST" enctype="multipart/form-data">
            <label for="firstname">First Name:</label>
            <input type="text" name="firstname" required><br><br>
            
            <label for="lastname">Last Name:</label>
            <input type="text" name="lastname" required><br><br>
            
            <label for="password">Password:</label>
            <input type="password" name="password" required><br><br>
            
            <label for="photo">Photo (optional):</label>
            <input type="file" name="photo" accept="image/*"><br><br>
            
            <button type="submit" name="add">Register</button>
        </form>

        <?php
        // Display any error messages
        if (isset($_SESSION['error'])) {
            echo "<p style='color:red;'>".$_SESSION['error']."</p>";
            unset($_SESSION['error']);
        }
        ?>
    </body>
    </html>