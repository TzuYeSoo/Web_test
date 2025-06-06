<?php
require_once "connection.php";
header('Content-Type: application/json');

if (!isset($_POST['user_id'])) {
    echo json_encode(["status" => "error", "message" => "Missing user_id"]);
    exit();
}

$user_id = $_POST['user_id'];

$stmt = $conn->prepare("
    SELECT 
        r.order_id,
        u.program_name, 
        ui.part AS uniform_part, 
        ui.price AS uniform_price, 
        r.order_total_price, 
        r.order_quantity, 
        r.pickup_date,
        r.order_status
    FROM reservation AS r
    INNER JOIN uniforms AS u ON r.uniform_id = u.uniform_id
    INNER JOIN uniform_inventory AS ui ON u.uniform_id = ui.uniform_id
    WHERE r.user_id = ?
    GROUP BY r.order_id
");

$stmt->bind_param("s", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$data = [];

while ($row = $result->fetch_assoc()) {
    $data[] = [
        "itemname"     => $row['program_name'] . " - " . $row['uniform_part'],
        "totalprice"   => $row['order_total_price'],
        "quantity"     => $row['order_quantity'],
        "pickupdate"   => $row['pickup_date'],
        "price"        => $row['uniform_price'],
        "order_status" => $row['order_status']
    ];
}

echo json_encode(["status" => "success", "reservations" => $data]);

$stmt->close();
$conn->close();
?>
