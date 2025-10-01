<?php
header('Content-Type: application/json');
include 'db.php';

$recipe_id = $conn->real_escape_string($_POST['recipe_id']);

if (empty($recipe_id)) {
    echo json_encode(['success' => false, 'message' => 'Recipe ID is missing.']);
    exit;
}

// The new SQL query does not use user_id
$sql = "INSERT INTO Favorites (recipe_id) VALUES ($recipe_id)";

if ($conn->query($sql) === TRUE) {
    echo json_encode(['success' => true, 'message' => 'Added to favorites!']);
} else {
    // This will catch if a recipe is already a favorite because of the UNIQUE KEY
    echo json_encode(['success' => false, 'message' => 'Already in favorites or another error occurred.']);
}

$conn->close();
?>