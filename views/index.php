<?php

declare(strict_types=1);

require_once(__DIR__ . "/../vendor/autoload.php");

if (isset($_COOKIE['jwt'])) {
  die(header("Location: /home "));
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <form action="/login" method="post">
    <h1>LOGIN</h1>
    <input type="email" placeholder="Email" name="email" required>
    <input type="password" placeholder="Password" name="password" required>
    <input type="submit">
  </form>
</body>

</html>