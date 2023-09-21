<?php

declare(strict_types=1);

use Firebase\JWT\JWT;
use app\classes\Users;
use app\classes\Validation;

define("JWT_SECRET", "SECRET-KEY");
define("JWT_ALGO", "HS512");

ini_set("display_errors", "1");
ini_set("display_startup_errors", "1");
error_reporting(E_ALL);

require_once(__DIR__ . "/../vendor/autoload.php");

$Users = new Users();
$Validation = new Validation();

$param = (isset($params) ? explode("/", $params) : header("Location: /error"));
$action = (isset($param[0]) ? $param[0] : die(header("Location: /error")));
$param1 = (isset($param[1]) ? $param[1] : "");
$param2 = (isset($param[2]) ? $param[2] : "");

if ($action === "login") {
  try {
    $email = (isset($_POST['email']) ? $Validation->input($_POST['email']) : "");
    $password = (isset($_POST['password']) ? $Validation->input($_POST['password']) : "");

    $count = $Users->count([$email]);
    if ($count === 0) {
      die(header("Location: /"));
    }

    $user = $Users->detail([$email]);
    $verify = password_verify($password, $user['password']);
    if (empty($verify)) {
      die(header("Location: /"));
    }

    $data = [
      "email" => $user['email'],
    ];
    $now = strtotime("now");
    $payload = [
      "iat" => $now,
      "exp" => $now + 3600,
      "data" => $data,
    ];
    $encode = JWT::encode($payload, JWT_SECRET, JWT_ALGO);

    setcookie("jwt", $encode);
    die(header("Location: /home"));
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

if ($action === "add") {
  try {
    $name = (isset($_POST['name']) ? $Validation->input($_POST['name']) : "");
    $email = (isset($_POST['email']) ? $Validation->input($_POST['email']) : "");
    $password = (isset($_POST['password']) ? $Validation->input($_POST['password']) : "");
    $password_hash = password_hash($password, PASSWORD_BCRYPT, ["cost" => 15]);

    $Users->add([$name, $email, $password_hash]);
    die(header("Location: /home"));
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}
