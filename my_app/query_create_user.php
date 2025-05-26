<?php
    require_once "connection.php";

    $username = $_POST['username'];
    $password = $_POST['password'];
    $firt_name = $_POST['firt_name'];
    $last_name = $_POST['last_name'];

    $query = "INSERT INTO user_account(firt_name, last_name, username, user_password, position, user_status) VALUES (?,?,?,?,?,?)";  
    $stms = $conn->prepare($query);

        if (!$stms) {
            die("Prepare failed: " . $conn->error);
        }

    $position = "student";
    $status = 1;

    $stms-> bind_param("sssssi", $firt_name, $last_name, $position, $username, $password, $status);


    if($stms->execute()){
        header("Location: Login_page.html");
        exit();
    }else{
        echo "invalid items";
    }

    $stms->close();
    $conn->close();
?>