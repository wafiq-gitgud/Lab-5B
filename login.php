<?php
session_start();
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $matric = $_POST['matric'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE matric = '$matric'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Verify the hashed password
        if (password_verify($password, $row['password'])) {
            $_SESSION['logged_in'] = true;
            $_SESSION['matric'] = $row['matric'];
            $_SESSION['name'] = $row['name'];
            header("Location: display.php");
            exit();
        } else {
            $error = "Invalid username or password, try <a href='login.php'>login</a> again.";
        }
    } else {
        $error = "Invalid username or password, try <a href='login.php'>login</a> again.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <?php if(isset($error)) echo "<p class='error'>$error</p>"; ?>
        <form method="POST" action="">
            <label>Matric:</label>
            <input type="text" name="matric" required>
            
            <label>Password:</label>
            <input type="password" name="password" required>
            
            <button type="submit">Login</button>
        </form>
        <br>
        <p><a href="register.php" class="link">Register here if you have not.</a></p>
    </div>
</body>
</html>
