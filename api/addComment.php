<?php
header('Content-Type: application/json');
include 'db.php';

$recipe_id = $conn->real_escape_string($_POST['recipe_id']);
$comment_text = $conn->real_escape_string($_POST['comment_text']);
$rating = intval($_POST['rating'] ?? 0);

if (empty($recipe_id) || empty($comment_text)) {
    echo json_encode(['success' => false, 'message' => 'Recipe ID or comment text is missing.']);
    exit;
}

$sql = "INSERT INTO comments (recipe_id, comment_text, rating) VALUES ('$recipe_id', '$comment_text', '$rating')";

if ($conn->query($sql) === TRUE) {
    echo json_encode(['success' => true, 'message' => 'Comment added successfully!']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error: ' . $conn->error]);
}

$conn->close();
?>