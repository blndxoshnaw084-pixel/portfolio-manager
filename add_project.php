<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $tech = $_POST['technology_used'];
    $desc = $_POST['description'];
    $owner = $_POST['owner_name'];
    $email = $_POST['owner_email'];
    $phone = $_POST['owner_phone'];

    $sql = "INSERT INTO projects (title, technology_used, description, owner_name, owner_email, owner_phone) 
            VALUES ('$title', '$tech', '$desc', '$owner', '$email', '$phone')";
    
    if ($conn->query($sql) === TRUE) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error", "message" => $conn->error]);
    }
}
$conn->close();
?>