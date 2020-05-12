<?php
  require_once 'User.php';
  require_once 'AdminConnection.php';

  /**
   * Administartor
   */
  class Admin
  {
    use adminBbConnecton;
    use appUser;

    function __construct()
    {
      $this->conn();
    }
  }
