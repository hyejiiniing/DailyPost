<?php
header('Content-Type: application/json; charset=UTF-8');
session_start();

require_once $_SERVER['DOCUMENT_ROOT'] . '/DailyPost/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/DailyPost/classes/BoardClass.php';

try {
    $board = new BoardClass($conn);
    $posts = $board->getList();

    if (empty($posts)) {
        echo json_encode(['status' => 'fail', 'message' => '게시글이 없습니다.'], JSON_UNESCAPED_UNICODE);
        exit;
    }

    echo json_encode(['status' => 'success', 'data' => $posts], JSON_UNESCAPED_UNICODE);
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()], JSON_UNESCAPED_UNICODE);
}
?>
