<?php
require_once 'User.php';
require_once 'SecureUserConnection.php';

  /**
   * Administartor
   */
  class SubUser
  {
    use secureUserBbConnecton;
    use appUser;


    function __construct()
    {
      
    }
  }
