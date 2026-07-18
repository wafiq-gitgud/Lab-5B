<?php
session_start();
if (!isset($_SESSION['logged_in'])) {
    header("Location: login.php");
    exit();
}
require 'db.php';

if (isset($_GET['matric'])) {
    $matric = $_GET['matric'];
    $sql = "SELECT * FROM users WHERE matric='$matric'";
    $result = $conn->query($sql);
    $user = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $old_matric = $_POST['old_matric'];
    $new_matric = $_POST['matric'];
    $name = $_POST['name'];
    $role = $_POST['role'];

    $sql = "UPDATE users SET matric='$new_matric', name='$name', role='$role' WHERE matric='$old_matric'";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: display.php");
        exit();
    } else {
        $error = "Error updating record: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Update User</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Update User</h2>
        <?php if(isset($error)) echo "<p class='error'>$error</p>"; ?>
        <form method="POST" action="">
            <input type="hidden" name="old_matric" value="<?php echo $user['matric']; ?>">
            
            <label>Matric:</label>
            <input type="text" name="matric" value="<?php echo $user['matric']; ?>" required>
            
            <label>Name:</label>
            <input type="text" name="name" value="<?php echo $user['name']; ?>" required>
            
            <label>Access Level:</label>
            <select name="role" required>
                <option value="lecturer" <?php if($user['role'] == 'lecturer') echo 'selected'; ?>>Lecturer</option>
                <option value="student" <?php if($user['role'] == 'student') echo 'selected'; ?>>Student</option>
            </select>
            
            <div style="display: flex; gap: 10px; align-items: center; margin-top: 10px;">
                <button type="submit">Update</button>
                <a href="display.php" class="link">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>
