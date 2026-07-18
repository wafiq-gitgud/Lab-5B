<?php
session_start();
if (!isset($_SESSION['logged_in'])) {
    header("Location: login.php");
    exit();
}
require 'db.php';

if (isset($_GET['matric'])) {
    $matric = $_GET['matric'];
    $sql = "DELETE FROM users WHERE matric='$matric'";
    $conn->query($sql);
}
header("Location: display.php");
exit();
?>
