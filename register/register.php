<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Voter</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ffeeee;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
        }
        h2 {
            color: #cc0000;
            text-align: center;
            margin-bottom: 1.5rem;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 0.5rem;
            color: black;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="file"] {
            padding: 0.5rem;
            margin-bottom: 1rem;
            border: 1px solid #cc0000;
            border-radius: 4px;
        }
        button {
            background-color: #cc0000;
            color: white;
            padding: 0.75rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
        }
        button:hover {
            background-color: #990000;
        }
        .back-button {
            position: absolute;
            top: 10px;
            left: 10px;
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
        .back-button:hover {
            background-color: #e0e0e0;
            transform: translateX(-3px);
        }
        .back-button::before {
            content: '←';
            margin-right: 5px;
            font-size: 18px;
        }
        .error {
            color: #cc0000;
            font-size: 0.9rem;
            margin-top: -0.5rem;
            margin-bottom: 0.5rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <button class="back-button" onclick="goBack()">Back</button>
        <h2>Register Voter</h2>
        <form action="process_register.php" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
            <label for="firstname">First Name:</label>
            <input type="text" id="firstname" name="firstname" required placeholder="e.g. John">
            <div id="firstnameError" class="error"></div>

            <label for="lastname">Last Name:</label>
            <input type="text" id="lastname" name="lastname" required placeholder="e.g. Doe">
            <div id="lastnameError" class="error"></div>

            <label for="email">Student Email:</label>
            <input type="email" id="email" name="email" required placeholder="e.g. 202256789@spu.ac.za">
            <div id="emailError" class="error"></div>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required placeholder="Enter your password">

            <label for="photo">Photo (optional):</label>
            <input type="file" id="photo" name="photo" accept="image/*">

            <button type="submit" name="register">Register</button>
        </form>
    </div>

    <script>
        function goBack() {
            window.history.back();
        }

        function validateForm() {
            const firstname = document.getElementById('firstname').value;
            const lastname = document.getElementById('lastname').value;
            const email = document.getElementById('email').value;
            const firstnameError = document.getElementById('firstnameError');
            const lastnameError = document.getElementById('lastnameError');
            const emailError = document.getElementById('emailError');
            let isValid = true;

            firstnameError.textContent = '';
            lastnameError.textContent = '';
            emailError.textContent = '';

            if (/\d/.test(firstname)) {
                firstnameError.textContent = "Name cannot contain a number";
                isValid = false;
            }

            if (/\d/.test(lastname)) {
                lastnameError.textContent = "Surname cannot contain a number";
                isValid = false;
            }

            const emailRegex = /^\d{9}@spu\.ac\.za$/;
            if (!emailRegex.test(email)) {
                emailError.textContent = "Email must be in the format: 202256789@spu.ac.za";
                isValid = false;
            }

            return isValid;
        }
    </script>
</body>
</html>