<?php
session_start();
require_once __DIR__ . '/../mysql/config/database.php';

if (!isset($_SESSION['user_id'])) {
echo "<script>alert('Please login to book.'); window.location.href='../frontend/login.html';</script>";
exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$checkin = isset($_POST['checkin_date']) ? $_POST['checkin_date'] : '';
$checkout = isset($_POST['checkout_date']) ? $_POST['checkout_date'] : '';
$guests = isset($_POST['guests']) ? (int)$_POST['guests'] : 0;
$roomType = isset($_POST['room_type']) ? $_POST['room_type'] : '';

if ($checkin === '' || $checkout === '' || $guests <= 0 || $roomType === '') {
echo "<script>alert('All booking fields are required.'); window.location.href='../frontend/checkin.html';</script>";
exit();
}

if (strtotime($checkout) <= strtotime($checkin)) {
echo "<script>alert('Check-out must be after check-in.'); window.location.href='../frontend/checkin.html';</script>";
exit();
}

$userId = $_SESSION['user_id'];

$stmt = mysqli_prepare($conn, "INSERT INTO bookings (user_id, checkin_date, checkout_date, guests, room_type, status) VALUES (?, ?, ?, ?, ?, 'confirmed')");
mysqli_stmt_bind_param($stmt, 'issis', $userId, $checkin, $checkout, $guests, $roomType);
if (mysqli_stmt_execute($stmt)) {
echo "<script>alert('Booking confirmed!'); window.location.href='details.php';</script>";
exit();
}

echo "<script>alert('Failed to create booking.'); window.location.href='../frontend/checkin.html';</script>";
}
?>