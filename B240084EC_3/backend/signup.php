<?php
session_start();
require_once __DIR__ . '/../mysql/config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$name = isset($_POST['name']) ? trim($_POST['name']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$passwordPlain = isset($_POST['password']) ? $_POST['password'] : '';
$confirm = isset($_POST['confirm']) ? $_POST['confirm'] : '';

if ($name === '' || $email === '' || $passwordPlain === '' || $confirm === '') {
echo "<script>alert('All fields are required.'); window.location.href='../frontend/signup.html';</script>";
exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
echo "<script>alert('Please enter a valid email.'); window.location.href='../frontend/signup.html';</script>";
exit;
}

if ($passwordPlain !== $confirm) {
echo "<script>alert('Passwords do not match.'); window.location.href='../frontend/signup.html';</script>";
exit;
}

$passwordHashed = password_hash($passwordPlain, PASSWORD_DEFAULT);

$checkStmt = mysqli_prepare($conn, "SELECT id FROM users WHERE email = ?");
mysqli_stmt_bind_param($checkStmt, 's', $email);
mysqli_stmt_execute($checkStmt);
$result = mysqli_stmt_get_result($checkStmt);
if ($result && mysqli_num_rows($result) > 0) {
echo "<script>alert('User with this email already exists. Please login.'); window.location.href='../frontend/login.html';</script>";
exit;
}

$insertStmt = mysqli_prepare($conn, "INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
mysqli_stmt_bind_param($insertStmt, 'sss', $name, $email, $passwordHashed);
if (mysqli_stmt_execute($insertStmt)) {
echo "<script>alert('Signup successful! Please login.'); window.location.href='../frontend/login.html';</script>";
exit;
}

echo "<script>alert('Error creating user.'); window.location.href='../frontend/signup.html';</script>";
}
?>