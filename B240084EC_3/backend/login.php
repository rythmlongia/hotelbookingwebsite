<?php
session_start();
require_once __DIR__ . '/../mysql/config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$pass = isset($_POST['password']) ? $_POST['password'] : '';

if ($email === '' || $pass === '') {
echo "<script>alert('Provide both email and password'); window.location.href='../frontend/login.html';</script>";
exit;
}

$stmt = mysqli_prepare($conn, "SELECT id, name, email, password FROM users WHERE email = ?");
mysqli_stmt_bind_param($stmt, 's', $email);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = $result ? mysqli_fetch_assoc($result) : null;

if ($user && password_verify($pass, $user['password'])) {
$_SESSION['user_id'] = $user['id'];
$_SESSION['user_name'] = $user['name'];
$_SESSION['user_email'] = $user['email'];
header('Location: ../frontend/index.html');
exit;
}

echo "<script>alert('Invalid email or password'); window.location.href='../frontend/login.html';</script>";
}
?>