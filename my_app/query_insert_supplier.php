<?php
require_once "connection.php";

$firt_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$company = $_POST['company'];  // ✅ correct spelling
$contact = $_POST['contact'];
$date_created = $_POST['date_created'];
$description = $_POST['descrition'];

$status = 1;

// ✅ Check if company already exists
$checkQuery = "SELECT * FROM supplier WHERE comapany_name = ?";
$checkStmt = $conn->prepare($checkQuery);

if (!$checkStmt) {
    die("Prepare failed: " . $conn->error);
}

$checkStmt->bind_param("s", $company);
$checkStmt->execute();
$result = $checkStmt->get_result();

if ($result->num_rows > 0) {
    // Use JavaScript alert and redirect
    echo "<script>
        alert('This company already exists.');
        window.history.back();
    </script>";
    exit();
}

$checkStmt->close();

// ✅ Proceed with insert
$insertQuery = "INSERT INTO supplier(firt_name, last_name, comapany_name, contact, user_status) VALUES (?, ?, ?, ?, ?)";
$insertStmt = $conn->prepare($insertQuery);

if (!$insertStmt) {
    die("Prepare failed: " . $conn->error);
}

$insertStmt->bind_param("ssssi", $firt_name, $last_name, $company, $contact, $status);

if ($insertStmt->execute()) {
    header("Location: supplier.html");
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
