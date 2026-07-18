<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $matric = $_POST['matric'];
    $name = $_POST['name'];
    // Best practice: always hash passwords
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); 
    $role = $_POST['role'];

    $sql = "INSERT INTO users (matric, name, password, role) VALUES ('$matric', '$name', '$password', '$role')";

    if ($conn->query($sql) === TRUE) {
        header("Location: login.php");
        exit();
    } else {
        $error = "Error: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Registration</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Register</h2>
        <?php if(isset($error)) echo "<p class='error'>$error</p>"; ?>
        <form method="POST" action="">
            <label>Matric:</label>
            <input type="text" name="matric" required>
            
            <label>Name:</label>
            <input type="text" name="name" required>
            
            <label>Password:</label>
            <input type="password" name="password" required>
            
            <label>Role:</label>
            <select name="role" required>
                <option value="">Please select</option>
                <option value="lecturer">Lecturer</option>
                <option value="student">Student</option>
            </select>
            
            <button type="submit">Submit</button>
        </form>
        <br>
        <p><a href="login.php" class="link">Already have an account? Login here.</a></p>
    </div>
</body>
</html>
