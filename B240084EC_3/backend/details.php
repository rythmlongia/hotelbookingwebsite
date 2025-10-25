<?php
session_start();
require_once __DIR__ . '/../mysql/config/database.php';

if (!isset($_SESSION['user_id'])) {
echo "<script>alert('Please login to view your bookings.'); window.location.href='../frontend/login.html';</script>";
exit();
}

$userId = $_SESSION['user_id'];

$query = "SELECT id, checkin_date, checkout_date, guests, room_type, status FROM bookings WHERE user_id = ? ORDER BY created_at DESC";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, 'i', $userId);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$bookings = $result ? mysqli_fetch_all($result, MYSQLI_ASSOC) : [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Bookings | HotelBook</title>
  <link rel="stylesheet" href="../frontend/detailsstyle.css">
  <link rel="stylesheet" href="../frontend/style.css">
</head>
<body>

  <nav class="navbar">
    <div class="logo">HotelBook</div>
    <ul class="nav-links">
      <li><a href="../frontend/index.html">Home</a></li>
      <li><a href="details.php" target="_blank">Bookings</a></li>
      <li><a href="../frontend/checkin.html" class="btn " target="_blank">Book Now</a></li>
      <li><a href="logout.php">Logout</a></li>
    </ul>
  </nav>

  <div class="bookings-container">
    <h2>My Reservations</h2>
    <p>Here are your current and past bookings.</p>

    <table class="bookings-table">
      <thead>
        <tr>
          <th>Booking ID</th>
          <th>Check-in</th>
          <th>Check-out</th>
          <th>Guests</th>
          <th>Room Type</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <?php if (empty($bookings)) { ?>
          <tr>
            <td colspan="6">No bookings found.</td>
          </tr>
        <?php } else { ?>
          <?php foreach ($bookings as $b) { ?>
            <tr>
              <td>#HB<?php echo htmlspecialchars($b['id']); ?></td>
              <td><?php echo htmlspecialchars($b['checkin_date']); ?></td>
              <td><?php echo htmlspecialchars($b['checkout_date']); ?></td>
              <td><?php echo htmlspecialchars($b['guests']); ?></td>
              <td><?php echo htmlspecialchars(ucfirst($b['room_type'])); ?></td>
              <td><span class="status <?php echo htmlspecialchars($b['status']); ?>"><?php echo htmlspecialchars(ucfirst($b['status'])); ?></span></td>
            </tr>
          <?php } ?>
        <?php } ?>
      </tbody>
    </table>
  </div>

</body>
</html>
