<?php
include 'db.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { 
    echo 'Invalid request'; 
    exit; 
}

// Keep your existing code for title, prep_time, servings, etc.
$title        = $conn->real_escape_string($_POST['recipeTitle'] ?? '');
$prep_time    = $conn->real_escape_string($_POST['prepTime'] ?? '');
$servings     = intval($_POST['servings'] ?? 0);
// ADD these lines for the new fields
$ingredients  = $conn->real_escape_string($_POST['recipeIngredients'] ?? '');
$instructions = $conn->real_escape_string($_POST['recipeInstructions'] ?? '');
// REMOVE the old description line
// $desc       = $conn->real_escape_string($_POST['recipeDescription'] ?? '');


// Keep your existing image handling logic
$image_url = '';
if (isset($_FILES['imageUpload']) && $_FILES['imageUpload']['error'] === UPLOAD_ERR_OK) {
    // ... (your existing image upload code is fine)
    $uploadsDir = 'uploads';
    if (!is_dir($uploadsDir)) mkdir($uploadsDir, 0755, true);
    $tmp = $_FILES['imageUpload']['tmp_name'];
    $name = basename($_FILES['imageUpload']['name']);
    $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
    $newName = uniqid('img_', true) . '.' . $ext;
    $target = $uploadsDir . '/' . $newName;
    if (move_uploaded_file($tmp, $target)) {
        $image_url = $conn->real_escape_string($target);
    }
}
if (empty($image_url) && !empty($_POST['imageUrl'])) {
    $image_url = $conn->real_escape_string($_POST['imageUrl']);
}

// UPDATE the SQL INSERT statement
$sql = "INSERT INTO recipes (title, prep_time, servings, image_url, ingredients, instructions) 
        VALUES ('$title', '$prep_time', $servings, '$image_url', '$ingredients', '$instructions')";

if ($conn->query($sql) === TRUE) {
    echo "Recipe added successfully!";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>