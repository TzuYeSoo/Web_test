<?php
require_once "connection.php";

$items = $_POST['items'];
$unif_name = $_POST['unif_name'];
$unif_program = $_POST['unif_program'];
$unif_quantity = $_POST['unif_quantity'];
$unif_description = $_POST['unif_description'];
$unif_price = 250.00;
$unif_status = 1;


foreach ($items as $item) {
    $fileKey = 'image_' . $item;

    if (isset($_FILES[$fileKey]) && $_FILES[$fileKey]['error'] == UPLOAD_ERR_OK) {
        $imageName = $_FILES[$fileKey]['name'];
        $imageTmpName = $_FILES[$fileKey]['tmp_name'];

        $targetDir = "uploads/";
        $targetPath = $targetDir . basename($imageName);

        if (move_uploaded_file($imageTmpName, $targetPath)) {
            // Example: insert into item_images(item_type, file_path) values (...)
            $stmt = $conn->prepare("INSERT INTO uniforms (program_id, uniform_name, uniform_quantity, uniform_price, uniform_part, uniform_status, image_unif) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("isiisis", $unif_program, $unif_name, $unif_quantity, $unif_price, $item, $unif_status, $targetPath);
            $stmt->execute();
            if ($stmt->affected_rows > 0) {
                header("Location: uniform.php");
            } else {
                echo "alert('Invalid Credentials')";
                header("Location: uniform.php");
            }
            $stmt->close();
        }
    }
}

$conn->close();
?>