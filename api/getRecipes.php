<?php
include 'db.php';

$sql = "SELECT * FROM recipes ORDER BY recipe_id DESC";
$result = $conn->query($sql);

$recipes = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $recipes[] = $row;
    }
}
echo json_encode($recipes);
?>
