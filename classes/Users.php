<?php

namespace app\classes;

use PDO;

class Users
{
  private $dbcon;

  public function __construct()
  {
    $db = new Database();
    $this->dbcon = $db->getConnection();
  }

  public function count($data)
  {
    $sql = "SELECT COUNT(*) FROM jwt.users WHERE email = ?";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetchColumn();
  }

  public function detail($data)
  {
    $sql = "SELECT * FROM jwt.users WHERE email = ?";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function add($data)
  {
    $sql = "INSERT INTO users(name,email,password) VALUES(?,?,?)";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }
}
