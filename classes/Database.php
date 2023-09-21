<?php

namespace app\classes;

use PDO;
use PDOException;

class Database
{
  private $dbCon = null;
  private $dbStmt = null;
  private $dbError;

  public function __construct()
  {
    $dns = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
    try {
      $this->dbCon = new PDO($dns, DB_USER, DB_PASSWORD, DB_OPTIONS);
    } catch (PDOException $e) {
      $this->dbError = "Failed to connect to DB: " . $e->getMessage();
      die($this->dbError);
    }
  }

  public function getConnection()
  {
    return $this->dbCon;
  }

  public function __destruct()
  {
    if ($this->dbStmt !== null) {
      $this->dbStmt = null;
    }
    if ($this->dbCon !== null) {
      $this->dbCon = null;
    }
  }
}

define("DB_HOST", "localhost");
define("DB_NAME", "jwt");
define("DB_CHARSET", "utf8");
define("DB_USER", "example");
define("DB_PASSWORD", "P@ssw0rd#db");
define("DB_OPTIONS", [
  PDO::ATTR_PERSISTENT          => true,
  PDO::ATTR_ERRMODE             => PDO::ERRMODE_EXCEPTION,
  PDO::ATTR_DEFAULT_FETCH_MODE  => PDO::FETCH_ASSOC,
  PDO::ATTR_EMULATE_PREPARES    => false,
]);
