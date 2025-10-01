<?php
$host = "deepakmysqldb.mysql.database.azure.com";   // your database host
$user = "mysqladmin@deepakmysqldb";        // database username
$pass = "hi@1234567";            // database password
$db   = "project";  // your database name

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
