<?php
$host = "localhost";   // your database host
$user = "root";        // database username
$pass = "12345";            // database password
$db   = "project";  // your database name

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
