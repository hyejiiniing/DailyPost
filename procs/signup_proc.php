<?php
include 'db.php';

$name = trim($_POST['name']);
$email = trim($_POST['email']);
$password = trim($_POST['password']);
$password_confirm = trim($_POST['password_confirm']);

if ($password !== $password_confirm) {
  echo "<script>alert('Passwords do not match.'); history.back();</script>";
  exit;
}

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$checkSql = "SELECT * FROM users WHERE email = '$email'";
$result = $conn->query($checkSql);

if ($result->num_rows > 0) {
  echo "<script>alert('Email already exists.'); history.back();</script>";
} else {
  $sql = "INSERT INTO users (username, password, name, email)
          VALUES ('$email', '$hashedPassword', '$name', '$email')";
  if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Sign up successful!'); location.href='login.php';</script>";
  } else {
    echo "<script>alert('Error: {$conn->error}'); history.back();</script>";
  }
}

$conn->close();
?>
