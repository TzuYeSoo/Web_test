<?php
    require_once "connection.php";

    $uniform_id = $_POST['uniform_id'];
    $user_id = $_POST['user_id'];
    $order_quantity = $_POST['order_quantity'];
    $order_total_price = $_POST['order_total_price'];
    $order_status = "reserved";
    $order_date = $_POST['order_date'];
    $pickup_date = $_POST['pickup_date'];


    // ✅ Proceed with insert
    $insertQuery = "INSERT INTO reservation(uniform_id, user_id, order_quantity, order_total_price, order_status, order_date, pickup_date) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $insertStmt = $conn->prepare($insertQuery);

    if (!$insertStmt) {
        die("Prepare failed: " . $conn->error);
    }

    $insertStmt->bind_param("iiiisss", $uniform_id, $user_id, $order_quantity, $order_total_price, $order_status, $order_date, $pickup_date);

    if ($insertStmt->execute()) {
        echo "<script>
            alert('Successfully added');
            window.history.back();
        </script>";
        exit();
    } else {
        echo "<script>
            alert('Error: Unable to add supplier.');
            window.history.back();
        </script>";
    }

    $insertStmt->close();
    $conn->close();


?>