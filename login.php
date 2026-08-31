<?php
require_once 'db_config.php';
// $conn = new mysqli("localhost", "root", "", "db_dynamic");

if (!$conn)
    die("Database connection failed.");
// else echo "Connected.";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | User Management</title>
    <!-- Stylesheets -->
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <h1 class="page-title">Login | User Management</h1>
    <div class="form-box">
        <h2 class="form-title">Sign In</h2>
        <form action="#" method="GET" name="user_form" novalidate>
            <div class="field-group">
                <label for="username">Username or E-mail</label>
                <input type="text" id="username" name="username" value="" required>
                <!-- <span class="error"> </span> -->   <!-- Commented because we are adding from JS -->
            </div>
            <div class="field-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" value="">
                <!-- <span class="error"> </span> -->   <!-- Commented because we are adding from JS -->
            </div>
            <div class="field-group">
                <input type="checkbox" id="remember" name="remember" value="1">
                <label for="remember">Remember login credentials.</label>
            </div>
            <button type="submit" name="submit">Login</button>
        </form>
        <hr>
        <div class="note">
            Don't you have an account? <a href="./register.php" class="text-link" title="">Register Now</a>
        </div>
        <hr>
        <a href="./forgot-password.php" class="text-link" title="">Forgot Password?</a>
        <hr>
        <a href="./index.php" class="text-link" title="">Back to Home</a>
    </div>

    <!-- Scripts -->
    <script src="./script.js"></script>
</body>

</html>