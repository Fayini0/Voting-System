<?php
session_start();
include 'includes/header.php';

// Assume you have a database connection established
$conn = mysqli_connect("localhost", "root", "", "votesystem");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['voter'])) {
    $voter_id = $_POST['voter'];
    $query = "SELECT password FROM voters WHERE voters_id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $voter_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $password = $row['password'];
    } else {
        $password = null;
    }
}

if (isset($_POST['new_password']) && isset($_POST['confirm_password'])) {
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if ($new_password === $confirm_password) {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $query = "UPDATE voters SET password = ? WHERE voters_id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "ss", $hashed_password, $voter_id);
        mysqli_stmt_execute($stmt);

        if (mysqli_stmt_affected_rows($stmt) > 0) {
            ?>
            <div class="callout callout-success text-center mt20">
                <p>Password updated successfully!</p>
            </div>
            <?php
        } else {
            ?>
            <div class="callout callout-danger text-center mt20">
                <p>Error updating password!</p>
            </div>
            <?php
        }
    } else {
        ?>
        <div class="callout callout-danger text-center mt20">
            <p>Passwords do not match!</p>
        </div>
        <?php
    }
}

mysqli_close($conn);
?>

<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <b>Student Portal</b>
    </div>

    <div class="login-box-body">
        <p class="login-box-msg">Forgot Password</p>

        <form action="forgot_password.php" method="POST">
            <div class="form-group has-feedback">
                <input type="text" class="form-control" name="voter" placeholder="Voter's ID" required>
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
        </form>

        <?php
        if (isset($password) && $password !== null) {
            ?>
            <form action="forgot_password.php" method="POST">
                <input type="hidden" name="voter" value="<?= $voter_id ?>">
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" name="new_password" placeholder="New Password" required>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    <small class="text-muted">Put a rememberable password</small>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password" required>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-8">
                        <button type="submit" class="btn btn-primary btn-block btn-flat" name="update_password"><i class="fa fa-lock"></i> Update Password</button>
                    </div>
                    <br>
                    <br>
                    <br>
                    
                    <div class="col-xs-7">
                        <a href="index.php" class="btn btn-default btn-block btn-flat">Back</a>
                    </div>
                </div>
            </form>
            <?php
        } elseif (isset($_POST['voter'])) {
            ?>
            <div class="callout callout-danger text-center mt20">
                <p>Voter ID not found!</p>
            </div>
            <?php
        }
        ?>

    </div>
</div>

<?php include 'includes/scripts.php' ?>
</body>
</html>