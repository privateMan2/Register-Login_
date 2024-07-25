<?php
include("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = hash('sha256', $_POST['password']); 

    $conn = new mysqli("localhost", "root", "", "user_db");

    if ($conn->connect_error) {
        die("Connection error: " . $conn->connect_error);
    }

    $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $email, $password);

    if ($stmt->execute()) {
        header("Location: login.html?email=$email");
        exit();
    } else {
        echo "Registration failed: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
