<?php
require_once "connection.php";
header('Content-Type: application/json');

// ✅ Validate all required POST fields
$required = ['user_id', 'uniform_id', 'student_name', 'order_quantity', 'order_total_price', 'pickup_date'];
foreach ($required as $field) {
    if (!isset($_POST[$field])) {
        echo json_encode(["status" => "error", "message" => "Missing field: $field"]);
        exit();
    }
}

// ✅ Assign values
$user_id = $_POST['user_id'];
$uniform_id = $_POST['uniform_id'];
$student_name = $_POST['student_name'];
$order_quantity = $_POST['order_quantity'];
$order_total_price = floatval($_POST['order_total_price']);
$pickup_date = $_POST['pickup_date'];
$order_date = date("Y-m-d");
$order_status = 'reserved';

// ✅ Prepare and bind
$stmt = $conn->prepare("INSERT INTO reservation (user_id, uniform_id, student_name, order_quantity, order_total_price, order_date, pickup_date, order_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("iissssss", $user_id, $uniform_id, $student_name, $order_quantity, $order_total_price, $order_date, $pickup_date, $order_status);

// ✅ Execute and check result
if ($stmt->execute()) {
    echo json_encode(["status" => "success", "message" => "Reservation successful"]);
} else {
    echo json_encode(["status" => "error", "message" => "Reservation failed: " . $stmt->error]);
}

$stmt->close();
$conn->close();
?>
