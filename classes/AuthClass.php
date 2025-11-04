<?php
class AuthClass {
  private $conn;

  public function __construct($conn) {
    $this->conn = $conn;
  }

  /* 회원가입 */
  public function register($email, $password, $name) {
    $hashed = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (email, password, name) VALUES (?, ?, ?)";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("sss", $email, $hashed, $name);
    return $stmt->execute();
  }

  /* 로그인 */
  public function login($email, $password) {
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
      $_SESSION['user_id'] = $user['id'];
      $_SESSION['user_email'] = $user['email'];
      $_SESSION['user_name'] = $user['name'];
      return true;
    }
    return false;
  }

  /* 로그아웃 */
  public function logout() {
    session_destroy();
    header("Location: signin.php");
    exit;
  }
}
