<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") {
    http_response_code(200);
    exit();
}

$host = "localhost";
$username = "root";
$password = "";
$database = "contact_db";

$conn = new mysqli(
    $host,
    $username,
    $password,
    $database
);

if ($conn->connect_error) {
    echo json_encode([
        "success" => false,
        "message" => "Database connection failed"
    ]);
    exit();
}

$data = json_decode(
    file_get_contents("php://input"),
    true
);

$name = trim($data["name"] ?? "");
$email = trim($data["email"] ?? "");
$message = trim($data["message"] ?? "");

if (
    empty($name) ||
    empty($email) ||
    empty($message)
) {
    echo json_encode([
        "success" => false,
        "message" => "All fields are required"
    ]);
    exit();
}

$sql = "INSERT INTO contacts
        (name, email, message)
        VALUES (?, ?, ?)";

$stmt = $conn->prepare($sql);

$stmt->bind_param(
    "sss",
    $name,
    $email,
    $message
);

if ($stmt->execute()) {
    echo json_encode([
        "success" => true,
        "message" => "Message saved successfully"
    ]);
} else {
    echo json_encode([
        "success" => false,
        "message" => "Message could not be saved"
    ]);
}

$stmt->close();
$conn->close();

?>