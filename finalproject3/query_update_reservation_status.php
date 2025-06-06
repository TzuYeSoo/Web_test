<?php
require_once "connection.php";

$order_id = $_GET['id'] ?? null;
$inventory_id = $_GET['inv_id'] ?? null;
$action = $_GET['action'] ?? null;

if (!$order_id || !$inventory_id || !in_array($action, ['complete', 'cancel'])) {
    die("Invalid parameters.");
}

$new_status = $action === 'complete' ? 'complete' : 'cancelled';
$reason = 'OUT';
$supplier_id = null;
$date_created = date("Y-m-d");

// Fetch order_quantity only
$query = "SELECT order_quantity FROM reservation WHERE order_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $order_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Reservation not found.");
}

$row = $result->fetch_assoc();
$order_quantity = $row['order_quantity'];
$stmt->close();

// Update reservation status
$update_res = $conn->prepare("UPDATE reservation SET order_status = ? WHERE order_id = ?");
$update_res->bind_param("si", $new_status, $order_id);
$update_success = $update_res->execute();
$update_res->close();

if ($update_success && $action === 'complete') {
    // Reduce stock
    $update_uniform = $conn->prepare("UPDATE uniform_inventory SET quantity = quantity - ? WHERE inventory_id = ?");
    $update_uniform->bind_param("ii", $order_quantity, $inventory_id);
    $update_uniform->execute();
    $update_uniform->close();

    // Insert stock movement
    $stock_movements = $conn->prepare("INSERT INTO uniform_stock_movement(inventory_id, supplier_id, stock_type, stock_quantity, date_created) 
                                       VALUES (?, ?, ?, ?, ?)");
    $stock_movements->bind_param("iisis", $inventory_id, $supplier_id, $reason, $order_quantity, $date_created);
    $stock_movements->execute();
    $stock_movements->close();
}

if ($update_success) {
    echo "<script>
        alert('Reservation marked as $new_status.');
        window.location.href='reservation.php';
    </script>";
} else {
    echo "<script>
        alert('Failed to update status.');
        window.history.back();
    </script>";
}

$conn->close();
?>
