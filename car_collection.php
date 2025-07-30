<?php
$conn = new mysqli("localhost", "root", "", "car_showroom");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM cars ORDER BY id DESC";

$search = "";
  if (isset($_GET['search'])) {
      $search = $conn->real_escape_string($_GET['search']);
      $sql = "SELECT * FROM cars WHERE name LIKE '%$search%' ORDER BY id DESC";
  } else {
      $sql = "SELECT * FROM cars ORDER BY id DESC";
  }

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Car Collection | First-Hand Cars</title>
  <style>
    body {
      background-image: url('images/back2.png');
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center;
      background-attachment: fixed;
      font-family: 'Segoe UI', sans-serif;
      margin: 0;
      padding: 20px;
    }

    h1 {
      text-align: center;
      margin-bottom: 30px;
      color: #333;
    }

    .car-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 30px;
      max-width: 1200px;
      margin: 0 auto;
    }

    .car-card {
      background: white;
      border-radius: 10px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
      overflow: hidden;
      transition: transform 0.2s ease;
    }

    .car-card:hover {
      transform: scale(1.02);
    }

    .car-image img {
      width: 100%;
      height: 180px;
      object-fit: cover;
    }

    .car-info {
      padding: 15px;
    }

    .car-name {
      font-size: 20px;
      font-weight: bold;
      margin-bottom: 8px;
      color: #222;
    }

    .car-price {
      color: #007bff;
      font-weight: bold;
      margin-bottom: 5px;
    }

    .car-rating {
      color: #f39c12;
      margin-bottom: 10px;
    }

    .book-btn {
      display: inline-block;
      padding: 10px 16px;
      background-color: #1b1f3a;
      color: white;
      text-decoration: none;
      border-radius: 5px;
      font-weight: bold;
    }

    .book-btn:hover {
      background-color: #1b1f3a;
    }

    @media (max-width: 768px) {
      .car-grid {
        grid-template-columns: repeat(2, 1fr);
      }
    }

    @media (max-width: 500px) {
      .car-grid {
        grid-template-columns: 1fr;
      }
    }

  .back-button {
    position: absolute;
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

<a href="index.php" class="back-button">← Back to Index</a>

  <h1>Explore Our Car Collection</h1>

  <form method="GET" action="" style="text-align: center; margin-bottom: 30px;">
  <input type="text" name="search" placeholder="Search by car name..." value="<?php echo htmlspecialchars($search); ?>"
         style="padding: 10px; width: 250px; font-size: 16px; border-radius: 5px; border: 1px solid #ccc;">
  <button type="submit" style="padding: 10px 16px; background-color: #1b1f3a; color: white; border: none; border-radius: 5px; font-weight: bold; cursor: pointer;">
    Search
  </button>
</form>

  <div class="car-grid">
  <?php if ($result->num_rows > 0): ?>
    <?php while($row = $result->fetch_assoc()) { ?>
      <div class="car-card">
        <div class="car-image">
          <img src="uploads/<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>">
        </div>

        <div class="car-info">
          <div class="car-name"><?php echo htmlspecialchars($row['name']); ?></div>
          <div class="car-price">₹<?php echo number_format($row['price'], 2); ?></div>
          <div class="car-rating"><?php echo str_repeat("★", $row['rating']) . str_repeat("☆", 5 - $row['rating']); ?></div>
          <a href="book_car.php?id=<?php echo $row['id']; ?>" class="book-btn">Book Now</a>
        </div>
      </div>
    <?php } ?>
  <?php else: ?>
    <div style="grid-column: 1 / -1; text-align: center; font-size: 18px; color: blacks; font-weight: bold;">
      No cars found matching "<?php echo htmlspecialchars($search); ?>".
      
    </div>
  <?php endif; ?>
</div>


</body>
</html>
