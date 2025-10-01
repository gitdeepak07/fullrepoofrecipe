<?php
header('Content-Type: application/json');
include 'db.php';

// The new SQL query selects all favorite recipe IDs
$sql = "SELECT recipe_id FROM Favorites";

$result = $conn->query($sql);
$favorite_ids = [];

if ($result) {
  while ($row = $result->fetch_assoc()) {
    $favorite_ids[] = $row['recipe_id'];
  }
}

echo json_encode(['success' => true, 'favorites' => $favorite_ids]);
$conn->close();
?>