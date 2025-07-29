<?php
session_start();
if (isset($_SESSION['admin'])) {
    header('location: admin/home.php');
}

if (isset($_SESSION['voter'])) {
    header('location: home.php');
}
?>
<?php include 'includes/header.php'; ?>
<style>
    body {
        margin: 0; /* Remove default margin */
        padding: 0; /* Remove default padding */
        height: 100vh; /* Full viewport height */
        background-color: #f4f4f4; /* Change background color if needed */
        display: flex; /* Use flexbox for centering */
        align-items: center; /* Vertically center the content */
        justify-content: center; /* Horizontally center the content */
    }

    .login-box {
        width: 600px; /* Set width of the login box */
        padding: 20px; /* Add padding for better spacing */
        border-radius: 8px; /* Rounded corners */
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Subtle shadow */
        background-color: #c30010; /* Background color for the login box */
    }

    .login-logo b {
        font-size: 32px; /* Increase logo font size */
        color: white;
    }

    .login-box-body {
        padding: 20px; /* Increase padding inside the box */
        background-color: #2E3135; /* Background color for the login box */
    }

    .form-control {
        font-size: 16px; /* Increase font size for inputs */
    }

    .btn {
        font-size: 16px; /* Increase button font size */
    }

    .login-box-msg {
        font-size: 18px; /* Increase font size for messages */
        margin-bottom: 20px; /* Space below the message */
        color: white;
    }

    .row {
        margin-bottom: 15px; /* Space below each row */
    }

    /* Style for error messages */
    .callout {
        position: fixed; /* Make the error message fixed */
        bottom: 20px; /* Place it at the bottom */
        left: 50%; /* Center it horizontally */
        transform: translateX(-50%); /* Adjust for centering */
        width: 300px; /* Set width for callout */
        z-index: 1000; /* Ensure it appears on top */
    }
</style>

<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <b>SPUEVOTEHUB</b>
    </div>

    <div class="login-box-body">
        <p class="login-box-msg">Register To Start Voting</p>

        <form action="login.php" method="POST">
            <div class="form-group has-feedback">
                <input type="text" class="form-control" name="voter" placeholder="Voter's ID" required>
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" name="password" placeholder="Password" required>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>

            <!-- Forgot Password Button -->
            <div class="form-group text-right">
                <a href="forgot_password.php">Forgot Password?</a>
            </div>

            <div class="row">
                <div class="col-xs-5">
                    <button type="submit" class="btn btn-primary btn-block btn-flat" name="login"><i class="fa fa-sign-in"></i> Sign In</button>
                </div>
                <div class="col-xs-7">
                    <a href="register/register.php" class="btn btn-danger btn-block btn-flat"><i class="fa fa-user-plus"></i> Register</a>
                </div>
            </div>
        </form>

        <!-- New Candidate Application Button -->
        <div class="row" style="margin-top: 20px;">
            <div class="col-xs-12">
                <a href="candidates/manage_votes_copy.php" class="btn btn-info btn-block btn-flat">
                    <i class="fa fa-user-plus"></i> Candidates Apply Here
                </a>
            </div>
        </div>
        <br><b>
        <a href="admin/index.php">
        <p class="login-box-msg">Admin Portal</p>
        </a>
        </b>
    </div>

</div>

<?php
if (isset($_SESSION['error'])) {
    echo "
        <div class='callout callout-danger text-center mt20'>
            <p>".$_SESSION['error']."</p> 
        </div>
    ";
    unset($_SESSION['error']);
}
?>

<?php include 'includes/scripts.php'; ?>
</body>
</html>
