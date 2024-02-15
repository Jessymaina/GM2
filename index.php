<?php
require_once('connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Form submitted
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate and sanitize input (you should implement proper validation and sanitization)
    $username = mysqli_real_escape_string($con, $username);
    $password = mysqli_real_escape_string($con, $password);

    // Hash the password using md5 (Note: It's recommended to use a more secure hashing algorithm)
    $hashedPassword = md5($password);

    // Query to check if user exists
    $query = "SELECT * FROM user WHERE username = '$username' AND userpassword = '$hashedPassword'";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        // User found, set session and redirect to grocery.php
        session_start();
        $_SESSION['user_email'] = $username; // Assuming $username is the email
        header("Location: grocery.php");
        exit();
    } else {
        // User not found, display an error message
        echo "<script>alert('Username or password do not match');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOG IN</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="login-form">
        <h2>Login</h2>
        <form action="" method="post">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="login-button">Login</button>
        </form>
        <a href="register.php">Create Account</a>
        <a href="home.php">Back to Home</a>
    </div>
</body>
</html>
