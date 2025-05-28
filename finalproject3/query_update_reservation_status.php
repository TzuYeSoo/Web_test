<?php
require_once "connection.php";

$order_id = $_GET['id'];
$action = $_GET['action'];

if (!$order_id || !in_array($action, ['complete', 'cancel'])) {
    die("Invalid parameters.");
}

$new_status = $action === 'complete' ? 'complete' : 'cancelled';

$stmt = $conn->prepare("UPDATE reservation SET order_status = ? WHERE order_id = ?");
$stmt->bind_param("si", $new_status, $order_id);

if ($stmt->execute()) {
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

$stmt->close();
$conn->close();
?>
