<?php
require_once 'User.php';
require_once 'safeUserConnection.php';

  /**
   * Administartor
   */
  class Moderator
  {
    use safeUserConnection;
    use appUser;
    
  }
