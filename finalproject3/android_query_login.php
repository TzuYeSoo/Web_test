<?php
require_once "connection.php";
header('Content-Type: application/json');

// ✅ Check if POST variables exist
if (!isset($_POST['username']) || !isset($_POST['password'])) {
    echo json_encode(["status" => "error", "message" => "Missing username or password"]);
    exit();
}

$username = $_POST['username'];
$password = $_POST['password'];

// ✅ Now proceed safely
$stmt = $conn->prepare("SELECT user_id, username, firt_name, last_name FROM user_account WHERE username=? AND user_password=? AND position='student'");
$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode([
    "status" => "success",
    "username" => $row['username'],
    "first_name" => $row['firt_name'],
    "user_id" => $row['user_id'],
    "last_name" => $row['last_name']]);
} else {
    echo json_encode(["status" => "error", "message" => "Invalid credentials"]);
}

$stmt->close();
$conn->close();
?>