<?php 
    require_once "connection.php";

    $teacher_id = $_POST['teacher_id'];
    $user_id = $_POST['user_id'];
    $item_name = $_POST['item_name'];
    $quantity = $_POST['quantity'];
    $date_created = $_POST['date_created'];


    // ✅ Proceed with insert
    $insertQuery = "INSERT INTO consumable_log(teacher_id, user_id, item_name, quantity, date_created) VALUES (?, ?, ?, ?, ?)";
    $insertStmt = $conn->prepare($insertQuery);

    if (!$insertStmt) {
        die("Prepare failed: " . $conn->error);
    }

    $insertStmt->bind_param("iisis", $teacher_id, $user_id, $item_name, $quantity, $date_created);

    if ($insertStmt->execute()) {
        header("Location: consumable.php");
        exit();
    } else {
        echo "<script>
            alert('Error: Unable to add consumable.');
            window.history.back();
        </script>";
    }

    $insertStmt->close();
    $conn->close();

?>