<?php
// admin_view_bookings.php
$conn = new mysqli("localhost", "root", "", "car_showroom");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle deletion if requested
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM bookings WHERE id = $id");
    echo "<script>alert('Booking deleted successfully.'); window.location='admin_view_bookings.php';</script>";
}

// Get all bookings
$sql = "SELECT b.*, c.name AS car_name 
        FROM bookings b 
        JOIN cars c ON b.car_id = c.id 
        ORDER BY b.booked_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin | View Bookings</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; background: #f4f4f4; }
        h2 { color: #333; }
        table { border-collapse: collapse; width: 100%; background: white; box-shadow: 0 0 8px #aaa; }
        th, td { padding: 12px; border: 1px solid #ccc; text-align: center; }
        th { background-color: #444; color: white; }
        tr:hover { background-color: #f0f0f0; }
        a.delete { color: red; text-decoration: none; font-weight: bold; }
        a.delete:hover { text-decoration: underline; }

            .back-button {
        /* position: fixed; */
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
        margin-bottom: 80%;
        transition: background-color 0.3s;
    }

    .back-button:hover {
        background-color: #0056b3;
    }
    </style>
</head>
<body>
    
<a href="admin_dashboard.php" class="back-button">← Back to Dashboard</a>

<h2>📋 All Car Bookings</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Car</th>
        <th>Name</th>
        <th>Phone</th>
        <th>Email</th>
        <th>Variant</th>
        <th>City</th>
        <th>Date</th>
        <th>Booked At</th>
        <th>Action</th>
    </tr>

    <?php if ($result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['car_name'] ?></td>
            <td><?= $row['customer_name'] ?></td>
            <td><?= $row['phone'] ?></td>
            <td><?= $row['email'] ?></td>
            <td><?= $row['variant'] ?></td>
            <td><?= $row['city'] ?></td>
            <td><?= $row['booking_date'] ?></td>
            <td><?= $row['booked_at'] ?></td>
            <td><a class="delete" href="?delete=<?= $row['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a></td>
        </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <tr><td colspan="10">No bookings found.</td></tr>
    <?php endif; ?>

</table>

</body>
</html>

<?php $conn->close(); ?>
