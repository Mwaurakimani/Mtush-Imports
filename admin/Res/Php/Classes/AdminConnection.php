<?php

  /**Object Oriented Database Connection
   *
   */
  trait  adminBbConnecton
  {
    protected $connection;

    function conn()
    {
      $this->connection = new mysqli(ROOT_DB_HOST,ROOT_DB_USERNAME,ROOT_DB_PASSWORD,ROOT_DB_NAME);

      return $this->connection;
    }
  }
