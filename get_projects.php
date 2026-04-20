<?php
header("Content-Type: application/json");
require 'db.php';

$sql = "SELECT * FROM projects ORDER BY id DESC";
$result = $conn->query($sql);

$projects = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $projects[] = $row;
    }
}

echo json_encode($projects);
$conn->close();
?>