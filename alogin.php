<?php
session_start();
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username == 'admin' && $password == 'admin123') {
        $_SESSION['admin_logged_in'] = true;
        header("location: dashboard.php");
        exit();
    } else {
        $error = "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <link rel="stylesheet" href="astyles.css">
</head>
<body>
    <div class="login-container">
        <h2>Admin Login</h2>
        <form method="post" action="alogin.php">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
            
        </form>
        <?php
         if (isset($error)) echo "<p class='error'>$error</p>"; ?>
    </div>
</body>
</html>
