<?php
include("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id'];
    $registration_approved = isset($_POST['registration_approved']) ? 1 : 0;

    $conn = new mysqli("localhost", "root", "", "user_db");

    if ($conn->connect_error) {
        die("Connection error: " . $conn->connect_error);
    }

    $sql = "UPDATE users SET registration_approved = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $registration_approved, $user_id);
    if ($stmt->execute()) {
        echo "Registration status successfully updated.";
    } else {
        echo "Failed to update registration status.";
    }

    $stmt->close();
    $conn->close();
}
?>
