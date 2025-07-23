<?php
session_start();

// // Optional: Check if admin is logged in
// if (!isset($_SESSION['admin_logged_in'])) {
//     header("Location: admin_login.php");
//     exit();
// }

// Connect to DB
$conn = new mysqli("localhost", "root", "", "car_showroom");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch customer data
$sql = "SELECT * FROM register_customer ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard - Customer List</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f8fb;
      padding: 40px;
    }
    h2 {
      color: #1b1f3a;
      text-align: center;
    }
    table {
      width: 90%;
      margin: 20px auto;
      border-collapse: collapse;
      background-color: #fff;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }
    th, td {
      padding: 12px 16px;
      border: 1px solid #ddd;
      text-align: center;
    }
    th {
      background-color: #1b1f3a;
      color: white;
    }
    tr:nth-child(even) {
      background-color: #f9f9f9;
    }
    .logout {
      display: block;
      width: 100px;
      margin: 0 auto;
      text-align: center;
      padding: 10px;
      background: #d62828;
      color: white;
      border-radius: 8px;
      text-decoration: none;
    }
    .logout:hover {
      background: #a61c1c;
    }
    .back-button {
    position: fixed;
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
<a href="admin_dashboard.php" class="back-button">← Back to Dashboard</a>
  <h2>All Registerd Customers Details</h2>

  <table>
    <tr>
      <th>ID</th>
      <th>Username</th>
      <th>Email</th>
      <th>Phone</th>
    </tr>
    <?php
    if ($result->num_rows > 0):
      while ($row = $result->fetch_assoc()):
    ?>
    <tr>
      <td><?php echo htmlspecialchars($row['id']); ?></td>
      <td><?php echo htmlspecialchars($row['name']); ?></td>
      <td><?php echo htmlspecialchars($row['email']); ?></td>
      <td><?php echo htmlspecialchars($row['phone']); ?></td>
    </tr>
    <?php endwhile; else: ?>
    <tr><td colspan="5">No customer records found.</td></tr>
    <?php endif; ?>
  </table>

  <a href="logout.php" class="logout">Logout</a>

</body>
</html>

<?php
$conn->close();
?>
