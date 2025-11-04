<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include '../db.php';
include '../classes/AuthClass.php';

$auth = new AuthClass($conn);

$email    = trim($_POST['email']);
$password = $_POST['password'];

if (empty($email)) {
    echo "<script>alert('이메일을 입력해주세요.'); history.back();</script>";
    exit;
}

if (empty($password)) {
    echo "<script>alert('비밀번호를 입력해주세요.'); history.back();</script>";
    exit;
}

if ($auth->login($email, $password)) {
    echo "<script>alert('로그인 성공!'); location.href='../index.php';</script>";
    exit;
} else {
    echo "<script>alert('이메일 또는 비밀번호가 잘못되었습니다.'); history.back();</script>";
    exit;
}
?>
