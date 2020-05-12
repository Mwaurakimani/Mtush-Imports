<?php
  require_once 'User.php';
  require_once 'SafeUserConnection.php';

/**
 * Safe User class
 * @uses User.php
 */
  class safeUser
  {
    use safeUserConnection;
    use appUser;
    use database;

    function __construct()
    {
      $this->conn();
    }


  }
