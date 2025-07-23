<?php
$conn = new mysqli("localhost", "root", "", "car_showroom");

$username = 'admin'; // Must match what is in DB
$password = 'admin123'; // What you expect to log in with

$stmt = $conn->prepare("SELECT password FROM admin_users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows == 1) {
    $stmt->bind_result($hashed_password);
    $stmt->fetch();

    if (password_verify($password, $hashed_password)) {
        echo "✅ Password matched!";
    } else {
        echo "❌ Incorrect password.";
    }
} else {
    echo "❌ Username not found.";
}
