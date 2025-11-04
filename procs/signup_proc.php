<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include '../db.php'; 
include '../classes/AuthClass.php';

$auth = new AuthClass($conn);

$name             = trim($_POST['name']);
$email            = trim($_POST['email']);
$password         = $_POST['password'];
$password_confirm = $_POST['password_confirm'];

if ($password !== $password_confirm) {
	echo "<script>alert('비밀번호가 일치하지 않습니다.'); history.back();</script>";
	exit;
}

$sql = "SELECT id FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
	echo "<script>alert('이미 가입된 이메일입니다.'); history.back();</script>";
	exit;
}

$sql = "INSERT INTO users (name, email, password, created_at) VALUES (?, ?, ?, NOW())";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $name, $email, $hashed);

if ($auth->register($email, $password, $name)) {
  $_SESSION['user_email'] = $email;
  $_SESSION['user_name'] = $name;
  $_SESSION['is_login'] = true;

  echo "<script>alert('회원가입이 완료되었습니다!'); location.href='../index.php';</script>";
  exit;
} else {
  echo "<script>alert('회원가입 중 오류가 발생했습니다.'); history.back();</script>";
  exit;
}
?>


