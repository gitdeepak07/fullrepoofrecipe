<?php
header('Content-Type: application/json');
include 'db.php';

$recipe_id = $conn->real_escape_string($_POST['recipe_id']);

if (empty($recipe_id)) {
    echo json_encode(['success' => false, 'message' => 'Recipe ID is missing.']);
    exit;
}

// The new SQL query deletes based on recipe_id only
$sql = "DELETE FROM Favorites WHERE recipe_id = $recipe_id";

if ($conn->query($sql) === TRUE) {
    echo json_encode(['success' => true, 'message' => 'Removed from favorites!']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error: ' . $conn->error]);
}

$conn->close();
?>