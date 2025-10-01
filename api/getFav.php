<?php
header('Content-Type: application/json');
include 'db.php';

// The new SQL query joins Favorites and Recipes without a user_id
$sql = "
  SELECT 
    r.recipe_id,
    r.title,
    r.description,
    r.image_url,
    r.prep_time,
    r.servings
  FROM Favorites f
  JOIN recipes r ON f.recipe_id = r.recipe_id
  ORDER BY f.fav_id DESC
";

$result = $conn->query($sql);
$favorites = [];

if ($result) {
  while ($row = $result->fetch_assoc()) {
    $favorites[] = $row;
  }
}

echo json_encode($favorites);
$conn->close();
?>