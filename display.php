<?php
session_start();
if (!isset($_SESSION['logged_in'])) {
    header("Location: login.php");
    exit();
}
require 'db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Users List</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container" style="max-width: 800px;">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h2>Users List</h2>
            <a href="logout.php" class="btn btn-danger">Logout</a>
        </div>
        <table>
            <tr>
                <th>Matric</th>
                <th>Name</th>
                <th>Level</th>
                <th>Action</th>
            </tr>
            <?php
            $sql = "SELECT matric, name, role FROM users";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>".$row["matric"]."</td>
                            <td>".$row["name"]."</td>
                            <td>".$row["role"]."</td>
                            <td>
                                <a href='update.php?matric=".$row["matric"]."' class='link'>Update</a> | 
                                <a href='delete.php?matric=".$row["matric"]."' class='link' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No users found</td></tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>
