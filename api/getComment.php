<?php
header('Content-Type: application/json');
include 'db.php';

$recipe_id = $conn->real_escape_string($_GET['recipe_id']);
$response = ['success' => false, 'comments' => [], 'avg_rating' => 0, 'rating_count' => 0];

if (!empty($recipe_id)) {
    // Get all comments for the recipe
    $sql_comments = "SELECT comment_text, rating, created_at FROM comments WHERE recipe_id = $recipe_id ORDER BY created_at DESC";
    $result_comments = $conn->query($sql_comments);
    
    if ($result_comments) {
        while ($row = $result_comments->fetch_assoc()) {
            $response['comments'][] = $row;
        }
    }

    // Calculate average rating and count for reviews that HAVE a rating
    $sql_avg = "SELECT AVG(rating) as avg_rating, COUNT(rating) as rating_count FROM comments WHERE recipe_id = $recipe_id AND rating > 0";
    $result_avg = $conn->query($sql_avg);
    
    if ($result_avg) {
        $avg_data = $result_avg->fetch_assoc();
        $response['avg_rating'] = round($avg_data['avg_rating'] ?? 0, 1);
        $response['rating_count'] = intval($avg_data['rating_count'] ?? 0);
    }
    
    $response['success'] = true;
}

echo json_encode($response);
$conn->close();
?>