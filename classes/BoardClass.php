<?php
class BoardClass {
  private $conn;
  private $table_name = "board";

  public function __construct($conn) {
    $this->conn = $conn;
  }

  public function create($notice_type, $user_id, $title, $content) {
    $sql = "INSERT INTO {$this->table_name} (notice_type, user_id, title, content, created_at)
            VALUES (?, ?, ?, ?, NOW())";
    $stmt = $this->conn->prepare($sql);
    if (!$stmt) {
      die("SQL prepare 실패: " . $this->conn->error);
    }
    $stmt->bind_param("siss", $notice_type, $user_id, $title, $content);
    return $stmt->execute();
  }

  public function getList() {
    $sql = "SELECT b.id, b.notice_type, b.user_id, u.name AS user_name, b.title, b.created_at
            FROM {$this->table_name} b
            LEFT JOIN user u ON b.user_id = u.id
            ORDER BY b.created_at DESC";
    $result = $this->conn->query($sql);

    $data = [];
    if ($result && $result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $data[] = $row;
      }
    }
    return $data;
  }

  public function getView($id) {
    $sql = "SELECT b.*, u.name AS user_name
            FROM {$this->table_name} b
            LEFT JOIN user u ON b.user_id = u.id
            WHERE b.id = ?";
    $stmt = $this->conn->prepare($sql);
    if (!$stmt) {
      die("SQL prepare 실패: " . $this->conn->error);
    }
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
  }

  public function delete($id, $user_id) {
    $sql = "DELETE FROM {$this->table_name} WHERE id = ? AND user_id = ?";
    $stmt = $this->conn->prepare($sql);
    if (!$stmt) {
      die("SQL prepare 실패: " . $this->conn->error);
    }
    $stmt->bind_param("ii", $id, $user_id);
    return $stmt->execute();
  }
}
?>
