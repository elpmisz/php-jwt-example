<?php

declare(strict_types=1);

use app\classes\Users;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

define("JWT_SECRET", "SECRET-KEY");
define("JWT_ALGO", "HS512");

require_once(__DIR__ . "/../vendor/autoload.php");

if (!isset($_COOKIE['jwt'])) {
  die(header("Location: / "));
}

$decode = JWT::decode($_COOKIE['jwt'], new Key(JWT_SECRET, JWT_ALGO));
$email = $decode->data->email;

$Users = new Users();
$user = $Users->detail([$email]);
echo "<pre>";
print_r($user);
echo "</pre>";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    div {
      margin-top: 5px;
      margin-bottom: 5px;
    }
  </style>
</head>

<body>
  <h1>Home Page</h1>
  <?php if (intval($user['level']) === 9) : ?>
    <form action="/add" method="post">
      <div class="row">
        <label>Name</label>
        <input type="text" name="name">
      </div>
      <div class="row">
        <label>E-Mail</label>
        <input type="email" name="email">
      </div>
      <div class="row">
        <label>Pasword</label>
        <input type="password" name="password">
      </div>
      <div class="row">
        <input type="submit">
      </div>
    </form>
  <?php endif; ?>
  <a href="/logout">Logout</a>
</body>

</html>