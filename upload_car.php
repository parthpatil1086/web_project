<?php
$conn = new mysqli("localhost", "root", "", "car_showroom");
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$msg = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = $_POST['name'];
  $price = $_POST['price'];
  $rating = $_POST['rating'];

  $image = $_FILES['image']['name'];
  $tmp = $_FILES['image']['tmp_name'];
  move_uploaded_file($tmp, "uploads/" . $image);

  $stmt = $conn->prepare("INSERT INTO cars (name, price, rating, image) VALUES (?, ?, ?, ?)");
  $stmt->bind_param("sdis", $name, $price, $rating, $image);
  if ($stmt->execute()) {
    $msg = "Car uploaded successfully!";
  } else {
    $msg = "Error: " . $conn->error;
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin - Upload Car</title>
  <style>
    form {
      max-width: 500px;
      margin: 50px auto;
      background: #fff;
      padding: 20px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    input, select {
      width: 100%;
      margin: 10px 0;
      padding: 10px;
    }
    button {
      background-color: #2a9d8f;
      color: white;
      padding: 10px;
      border: none;
      cursor: pointer;
    }
    .msg {
      text-align: center;
      color: green;
    }

    .back-button {
    position: fixed;
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
    transition: background-color 0.3s;
  }

  .back-button:hover {
    background-color: #0056b3;
  }
  </style>
</head>
<body>

<a href="admin_dashboard.php" class="back-button">← Back to Dashboard</a>
<form method="POST" enctype="multipart/form-data">
  <h2>Upload New Car</h2>
  <input type="text" name="name" placeholder="Car Name" required>
  <input type="number" name="price" placeholder="Price" required>
  <select name="rating" required>
    <option value="">Select Rating</option>
    <option value="5">★★★★★</option>
    <option value="4">★★★★☆</option>
    <option value="3">★★★☆☆</option>
    <option value="2">★★☆☆☆</option>
    <option value="1">★☆☆☆☆</option>
  </select>
  <input type="file" name="image" required>
  <button type="submit">Upload</button>
  <div class="msg"><?php echo $msg; ?></div>
</form>

</body>
</html>
