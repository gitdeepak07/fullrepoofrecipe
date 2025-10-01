<?php
// increase limits (this only works if Azure allows php.ini overrides)
// safer: keep a .user.ini file instead
ini_set('upload_max_filesize', '20M');
ini_set('post_max_size', '20M');

// Database config
$host = "deepakmysqldb.mysql.database.azure.com";   // your database host
$user = "mysqladmin@deepakmysqldb";                 // database username
$pass = "hi@1234567";                               // database password
$db   = "project";                                  // your database name

$conn = new mysqli($host, $user, $pass, $db);

// check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
