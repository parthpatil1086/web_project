<?php
session_start();
$conn = new mysqli("localhost", "root", "", "car_showroom");

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $delete_id = intval($_POST['delete_id']);

    $res = $conn->query("SELECT image FROM cars WHERE id = $delete_id");
    if ($res && $row = $res->fetch_assoc()) {
        $img_path = 'uploads/' . $row['image'];
        if (file_exists($img_path)) unlink($img_path);
    }

    $conn->query("DELETE FROM cars WHERE id = $delete_id");
}

$result = $conn->query("SELECT * FROM cars ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin - Manage Cars</title>
  <style>
    body {
      background-image: url('images/back1.png');
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center;
      background-attachment: fixed;
      background-size: cover;
      font-family: Arial, sans-serif;
      padding: 30px;
    }
    .car-card {
      display: flex;
      align-items: center;
      background: white;
      margin-bottom: 20px;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }
    .car-card img {
      width: 200px;
      height: 120px;
      object-fit: cover;
      margin-right: 20px;
      border-radius: 5px;
    }
    .car-info {
      flex-grow: 1;
    }
    .car-info h3 {
      margin: 0 0 5px;
    }
    .delete-btn {
      background-color: #d9534f;
      color: white;
      border: none;
      padding: 8px 14px;
      border-radius: 5px;
      cursor: pointer;
    }
    h2{
      margin:20px;
    }

    .back-button {
    /* position: fixed; */
    top: 20px;
    left: 20px;
    background-color: #007BFF;
    color: white;
    padding: 10px 16px;
    border-radius: 5px;
    text-decoration: none;
    font-weight: bold;
    font-family: Arial, sans-serif;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    z-index: 999;
    margin-bottom: 80%;
    transition: background-color 0.3s;
  }

  .back-button:hover {
    background-color: #0056b3;
  }

  .upload-button {
    /* position: fixed; */
    top: 20px;
    right: 20px;
    background-color: #007BFF;
    color: white;
    padding: 10px 16px;
    border-radius: 5px;
    text-decoration: none;
    font-weight: bold;
    font-family: Arial, sans-serif;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    z-index: 999;
    margin-bottom: 80%;
    transition: background-color 0.3s;
  }

  .upload-button:hover {
    background-color: #0056b3;
  }

  </style>
</head>
<body>

<a href="admin_dashboard.php" class="back-button">← Back to Dashboard</a>

<a href="upload_car.php" class="upload-button">Upload New Car</a>
  <h2>Admin - Car Collection</h2>

  <?php if ($result && $result->num_rows > 0): ?>
    <?php while ($row = $result->fetch_assoc()): ?>
      <div class="car-card">
        <img src="uploads/<?php echo htmlspecialchars($row['image']); ?>" alt="Car Image">
        <div class="car-info">
          <h3><?php echo htmlspecialchars($row['name']); ?></h3>
          <p>Price: ₹<?php echo number_format($row['price']); ?></p>
          <p>Rating: 
            <?php for ($i = 0; $i < $row['rating']; $i++) echo "★"; ?>
            <?php for ($i = $row['rating']; $i < 5; $i++) echo "☆"; ?>
          </p>
        </div>
        <form method="POST" onsubmit="return confirm('Are you sure you want to delete this car?');">
          <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
          <button type="submit" class="delete-btn">Delete</button>
        </form>
      </div>
    <?php endwhile; ?>
  <?php else: ?>
    <p>No cars available.</p>
  <?php endif; ?>

</body>
</html>
