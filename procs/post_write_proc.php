<?php
session_start();
include '../DailyPost/db.php';
include '../DailyPost/classes/BoardClass.php';

if (!isset($_SESSION['user_id'])) {
  echo "<script>alert('로그인 후 이용해주세요.'); location.href='../signin.php';</script>";
  exit;
}

$user_id = $_SESSION['user_id'];
$title = trim($_POST['title']);
$content = trim($_POST['content']);
$notice_type = 'post';

$board = new BoardClass($conn);

if ($board->create($notice_type, $user_id, $title, $content)) {
  echo "<script>alert('게시글이 등록되었습니다.'); location.href='../DailyPost/index.php';</script>";
} else {
  echo "<script>alert('등록 중 오류가 발생했습니다.'); history.back();</script>";
}
?>
