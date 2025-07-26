<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name     = trim(htmlspecialchars($_POST['fullname']));
    $email    = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
    $phone    = trim($_POST['phone']);
    $password = $_POST['password'];

    if (!$email) {
        echo "<script>alert('Invalid email format');</script>";
        exit;
    }

    if (!is_numeric($phone) || strlen($phone) < 10) {
        echo "<script>alert('Invalid phone number');</script>";
        exit;
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $conn = new mysqli("localhost", "root", "", "car_showroom");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $check = $conn->prepare("SELECT id FROM register_customer WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        echo "<script>alert('Email already registered!');</script>";
    } else {
        $stmt = $conn->prepare("INSERT INTO register_customer (name, email, phone, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $phone, $hashed_password);

        if ($stmt->execute()) {
            echo "<script>alert('Registration successful!'); window.location.href='customer_login.php';</script>";
        } else {
            echo "<script>alert('Error occurred during registration.');</script>";
        }

        $stmt->close();
    }

    $check->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>New Customer Registration</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
  <style>
    body {
      background-color: #1b1f3a;
      font-family: 'Segoe UI', sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .register-box {
      background-color: #fff;
      padding: 40px;
      border-radius: 12px;
      width: 100%;
      max-width: 450px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.3);
    }

    .register-box h2 {
      margin-bottom: 25px;
      text-align: center;
      color: #1b1f3a;
    }

    .register-box input {
      width: 100%;
      padding: 12px;
      margin: 10px 0;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 16px;
    }

    .register-box button {
      width: 100%;
      background-color: #d62828;
      color: white;
      padding: 12px;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    .register-box button:hover {
      background-color: #a61c1c;
    }

    .back-button {
    position: absolute;
    top: 20px;
    left: 20px;
    background-color: #007BFF; /* Bootstrap blue */
    color: white;
    padding: 10px 16px;
    border-radius: 5px;
    text-decoration: none;
    font-weight: bold;
    font-family: Arial, sans-serif;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    z-index: 999;
    transition: background-color 0.3s;
  }

  .back-button:hover {
    background-color: #0056b3;
  }
  </style>
</head>
<body>

  <a href="index.php" class="back-button">← Back to Index</a>

  <div class="register-box">
    <h2>New Customer Registration</h2>
    <form method="POST" action="">
      <input type="text" name="fullname" placeholder="Full Name" required />
      <input type="email" name="email" placeholder="Email" required />
      <input type="tel" name="phone" placeholder="Phone Number" required />
      <input type="password" name="password" placeholder="Password" required />
      <button type="submit">Register</button>
    </form>
  </div>

</body>
</html>
