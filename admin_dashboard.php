<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard</title>
  <style>
    body {
      background-image: url('images/back1.png');
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center;
      background-attachment: fixed;
      background-size: cover;
      font-family: Arial, sans-serif;
      background-color: #f4f8fb;
      text-align: center;
      padding: 60px;
    }

    h1 {
      color: #1b1f3a;
      margin-bottom: 40px;
    }

    .button-container {
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      gap: 30px;
    }

    .admin-button {
      padding: 15px 30px;
      font-size: 16px;
      background-color: #1b1f3a;
      color: white;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .admin-button:hover {
      background-color: #2e3c70;
    }

    .logout {
      margin-top: 50px;
      display: inline-block;
      padding: 10px 20px;
      background-color: #d62828;
      color: white;
      text-decoration: none;
      border-radius: 8px;
    }

    .logout:hover {
      background-color: #a61c1c;
    }
  </style>
</head>
<body>

  <h1>Admin Dashboard</h1>

  <div class="button-container">
    <button class="admin-button" onclick="location.href='view_customer.php'">Customer Details</button>
    <button class="admin-button" onclick="location.href='admin_view_bookings.php'">View Booking Requests</button>
    <button class="admin-button" onclick="location.href='admin_manage_cars.php'">Manage cars</button>

  </div>

  <a href="logout.php" class="logout">Logout</a>

</body>
</html>
