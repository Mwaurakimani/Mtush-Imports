<?php

  /**Object Oriented Database Connection
   *
   */
  trait secureUserBbConnecton
  {
    private $connection;

    function conn()
    {
     $this->connection = new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);

      return $this->connection;
    }
  }
