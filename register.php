<?php
$conn = new mysqli("localhost", "root", "", "db_dynamic");

if (!$conn)
    die("Database connection failed.");
// else echo "Connected.";

// print_r($_POST);
if (isset($_POST["submit"])) {
    // print_r($_POST);
    $fname = $_POST["fullname"];
    $email = $_POST["email"];
    $uname = $_POST["username"];
    $pwd = $_POST["password"];
    $cpwn = $_POST["cpassword"];
    $agree = $_POST["agree"];

    $sql = "INSERT INTO users (fullname, email, username, password, agree) VALUES ('$fname', '$email', '$uname', '$pwd','$agree')";

    mysqli_query($conn, $sql) or die("Query failed."); // query execution.
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | User Management</title>
    <!-- Stylesheets -->
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <h1 class="page-title">Register | User Management</h1>
    <div class="form-box">
        <h2 class="form-title">Sign Up</h2>
        <form action="#" method="POST" name="user_form" novalidate>
            <div class="field-group">
                <label for="fullname">Full Name</label>
                <input type="text" id="fullname" name="fullname" value="">
            </div>
            <div class="field-group">
                <label for="email">E-Mail</label>
                <input type="email" id="email" name="email" value="">
            </div>
            <div class="field-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" value="">
            </div>
            <div class="field-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" value="">
            </div>
            <div class="field-group">
                <label for="cpassword">Confrim Password</label>
                <input type="password" id="cpassword" name="cpassword" value="">
            </div>
            <div class="field-group">
                <input type="checkbox" id="agree" name="agree" value="1">
                <label for="agree">I agree with the <a href="#" title="">Terms &amp; Conditions</a>.</label>
            </div>
            <button type="submit" name="submit">Register</button>
        </form>
        <hr>
        <div class="note">
            Already have an account? <a href="./login.html" class="text-link" title="">Login Now</a>
        </div>
        <hr>
        <a href="./index.html" class="text-link" title="">Back to Home</a>
    </div>

    <!-- Scripts -->
    <script src="./script.js"></script>
</body>

</html>