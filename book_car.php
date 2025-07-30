<?php
$conn = new mysqli("localhost", "root", "", "car_showroom");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$booking_success = false;
$booking_error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['car_id'])) {
    $car_id = intval($_POST['car_id']);
    $name = $conn->real_escape_string($_POST['name']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $email = $conn->real_escape_string($_POST['email']);
    $variant = $conn->real_escape_string($_POST['variant']);
    $city = $conn->real_escape_string($_POST['city']);
    $booking_date = $_POST['date'];

    $sql = "INSERT INTO bookings (car_id, customer_name, phone, email, variant, city, booking_date)
            VALUES ($car_id, '$name', '$phone', '$email', '$variant', '$city', '$booking_date')";

    if ($conn->query($sql) === TRUE) {
        $booking_success = true;
    } else {
        $booking_error = "Booking failed: " . $conn->error;
    }
}

$car_id = isset($_GET['id']) ? intval($_GET['id']) : (isset($_POST['car_id']) ? intval($_POST['car_id']) : 0);

$sql = "SELECT * FROM cars WHERE id = $car_id";
$result = $conn->query($sql);
$car = $result->fetch_assoc();
if (!$car) {
    die("Car not found.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Book Your Dream Car</title>
  <style>
    body {
      background-image: url('images/back2.png');
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center;
      background-attachment: fixed;
      background-size: cover;
      min-height: 100vh;
      position: relative;
    }
    body::before {
      content: "";
      position: fixed;
      top: 0; left: 0;
      width: 100%; height: 100%;
      background-color: rgba(3, 3, 3, 0.5);
      z-index: -1;
    }
    h1 {
      text-align: center;
      color: white;
      font-size: 28px;
    }
    .container {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      padding: 20px;
      gap: 30px;
    }
    .car-section {
      flex: 1 1 500px;
      background: white;
      border-radius: 12px;
      padding: 20px;
      box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
    }
    .car-section img {
      width: 100%;
      border-radius: 8px;
    }
    .car-info {
      margin-top: 20px;
    }
    .car-info p {
      margin: 8px 0;
    }
    .price {
      color: green;
      font-size: 24px;
      margin: 10px 0;
    }
    .rating {
      color: gold;
      font-size: 20px;
    }
    .form-section {
      flex: 1 1 400px;
      background: rgba(255, 255, 255, 0.9);
      border-radius: 12px;
      padding: 30px;
      box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
    }
    .form-section h2 {
      margin-bottom: 20px;
      color: #003366;
    }
    .form-group {
      margin-bottom: 15px;
    }
    label {
      display: block;
      margin-bottom: 5px;
      font-weight: bold;
    }
    input, select {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 6px;
    }
    button {
      background-color: #007acc;
      color: white;
      border: none;
      padding: 12px 20px;
      border-radius: 6px;
      cursor: pointer;
    }
    button:hover {
      background-color: #005999;
    }
    .message {
      padding: 15px;
      margin-bottom: 20px;
      border-radius: 6px;
      font-weight: bold;
    }
    .success {
      background-color: #d4edda;
      color: #155724;
    }
    .error {
      background-color: #f8d7da;
      color: #721c24;
    }
    .back-button {
        position: absolute;
        top: 10px;
        left: 20px;
        background-color: #007BFF;
        color: white;
        padding: 10px 15px;
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
  </style>
</head>
<body>

  <a href="car_collection.php" class="back-button">← Back to Collections</a>
  <h1>Book Your Dream Car</h1>

  <div class="container">
    
    <div class="car-section">
      <img src="uploads/<?php echo htmlspecialchars($car['image']); ?>" alt="Car Image">
      <div class="car-info">
        <div class="rating">
          <?php echo str_repeat("★", $car['rating']) . str_repeat("☆", 5 - $car['rating']); ?>
        </div>
        <div class="price">₹<?php echo number_format($car['price'], 2); ?></div>
        <p><strong>Name:</strong> <?php echo htmlspecialchars($car['name']); ?></p>
        <p><strong>Fuel Type:</strong> Petrol</p>
        <p><strong>Engine:</strong> 1197cc</p>
        <p><strong>Transmission:</strong> Manual</p>
        <p><strong>Seats:</strong> 5</p>
      </div>
    </div>

    <div class="form-section">
      <h2>Booking Form</h2>
      <?php if ($booking_success): ?>
        <script>alert('Booking successful! Thank you for booking') </script>;

      <?php elseif ($booking_error): ?>
        <script>alert('error !!!') </script>; 
      <?php endif; ?>

      <form method="POST" onsubmit="return validateForm()">
        <input type="hidden" name="car_id" value="<?php echo $car['id']; ?>">
        <div class="form-group">
          <label for="name">Your Name:</label>
          <input type="text" name="name" id="name" required>
        </div>
        <div class="form-group">
          <label for="phone">Phone Number:</label>
          <input type="tel" name="phone" id="phone" required>
        </div>

        <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" name="email" id="email" required>
        </div>

        <div class="form-group">
          <label for="variant">Preferred Variant:</label>
          <select name="variant" id="variant" required>
            <option value="">-- Select Variant --</option>
            <option value="top">Top</option>
            <option value="second_top">Second Top</option>
            <option value="base">Base</option>
          </select>
        </div>

        <div class="form-group">
          <label for="city">Expected Delivery City:</label>
          <input type="text" name="city" id="city" required>
        </div>

        <div class="form-group">
          <label for="date">Booking Date:</label>
          <input type="date" name="date" id="date" required>
        </div>
        <button type="submit">Submit Booking</button>
      </form>
    </div>
  </div>

  <script>
  function validateForm() {
    
    const name = document.getElementById("name").value.trim();
    const phone = document.getElementById("phone").value.trim();
    const email = document.getElementById("email").value.trim();

    const namePattern = /^[A-Za-z\s]{2,}$/;
    const phonePattern = /^[0-9]{10}$/;
    const emailPattern = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/i;

    if (!namePattern.test(name)) {
      alert("Please enter a valid name (only letters, at least 2 characters).");
      return false;
    }

    if (!phonePattern.test(phone)) {
      alert("Please enter a valid 10-digit phone number.");
      return false;
    }

    if (!emailPattern.test(email)) {
      alert("Please enter a valid email address.");
      return false;
    }

    return true;
  }
</script>

</body>
</html>
