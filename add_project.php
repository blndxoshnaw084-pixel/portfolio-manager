<?php
// ڕێگەپێدان بە وێبسایتەکەی GitHub بۆ ناردنی داتا
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $tech = $_POST['technology_used'];
    $desc = $_POST['description'];

    $sql = "INSERT INTO projects (title, technology_used, description) VALUES ('$title', '$tech', '$desc')";
    
    if ($conn->query($sql) === TRUE) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error", "message" => $conn->error]);
    }
}
$conn->close();
?>