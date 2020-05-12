<?php
  require_once 'User.php';
  require_once 'AdminConnection.php';

  /**
   * Administartor
   */
  class AdminUser
  {
    use adminBbConnecton;
    use appUser;

    function __construct()
    {
      $this->conn();
    }

  public function deleteall($table, $conn)
  {
    $stmt = "DELETE from $table";
    if (false === $stmt) {
      die('execute() failed: ' . htmlspecialchars($stmt->error));
    }
    $result = $conn->prepare($stmt);
    if (false === $result) {
      die('execute() failed: ' . htmlspecialchars($conn->error));
    }
    $src = $result->execute();
    if (false === $src) {
      die('execute() failed: ' . htmlspecialchars($stmt->error));
    }
  }

  public function deleteitem ($ref,$table,$conn)
  {
    $stmt = $conn->prepare("DELETE from $table WHERE UUID = ?");
    $stmt->bind_param('s', $ref);
    $stmt->execute();
    $stmt->close();

    if($stmt){
      return true;
    }else{
      return false;
    }
  }

  }
