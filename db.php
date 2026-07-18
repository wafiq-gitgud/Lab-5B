<?php
$host = 'localhost';
$user = 'root'; // default XAMPP user
$pass = ''; // default XAMPP password is empty
$dbname = 'Lab_5b';

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
