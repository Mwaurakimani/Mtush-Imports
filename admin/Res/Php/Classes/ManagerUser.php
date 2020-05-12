<?php
  require_once 'User.php';
  require_once 'SecureUserConnection.php';

  /**
   * Administartor
   */
  class ManagerUser
  {
    use secureUserBbConnecton;
    use appUser;


    function __construct()
    {
      $this->conn();
    }
  }
