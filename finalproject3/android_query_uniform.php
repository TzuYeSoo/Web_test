<?php
require_once "connection.php";

$query = "SELECT image_unif, program_name AS label, price, quantity, part, size, u.uniform_id 
          FROM uniforms AS u 
          INNER JOIN uniform_inventory AS ui ON u.uniform_id = ui.uniform_id";

$result = $conn->query($query);

if (!$result) {
    die("Query Failed: " . $conn->error);
}

$data = [];

while ($row = $result->fetch_assoc()) {
    $imagePath = $row['image_unif'];
    $fullPath = __DIR__ . '/' . $imagePath;

    if (file_exists($fullPath)) {
        $imageData = base64_encode(file_get_contents($fullPath));
        $imageBase64 = 'data:image/jpeg;base64,' . $imageData;
    } else {
        $imageBase64 = null;
    }

    $data[] = [
        'image' => $imageBase64,
        'label' => $row['label'],
        'price' => $row['price'],
        'quantity' => $row['quantity'],
        'part' => $row['part'],
        'size' => $row['size'],
        'id' => $row['uniform_id']
    ];
}

header('Content-Type: application/json');
echo json_encode($data);

?>
