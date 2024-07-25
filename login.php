<?php
include("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = hash('sha256', $_POST['password']); 

    $conn = new mysqli("localhost", "root", "", "user_db");

    if ($conn->connect_error) {
        die("Connection error: " . $conn->connect_error);
    }

    $sql = "SELECT id, username, password, registration_approved FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $username, $hashed_password, $registration_approved);
    $stmt->fetch();

    if ($stmt->num_rows > 0) {
        if ($password === $hashed_password) {
            echo "Login successful! Welcome, $username!";
            echo '<form method="post" action="registration_approval.php">
                    <input type="hidden" name="user_id" value="' . $id . '">
                    <label>
                        <input type="checkbox" name="registration_approved" ' . ($registration_approved ? 'checked' : '') . '> I approve my registration
                    </label>
                    <button type="submit">Save</button>
                  </form>';
        } else {
            echo "Invalid email or password.";
        }
    } else {
        echo "Invalid email or password.";
    }

    $stmt->close();
    $conn->close();
}
?>
