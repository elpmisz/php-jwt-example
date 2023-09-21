<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once(__DIR__ . "/vendor/autoload.php");
$Router = new AltoRouter();

$Router->map("GET", "/", function () {
  require(__DIR__ . "/views/index.php");
});
$Router->map("GET", "/home", function () {
  require(__DIR__ . "/views/home.php");
});
$Router->map("GET", "/logout", function () {
  require(__DIR__ . "/views/logout.php");
});
$Router->map("POST", "/[**:params]", function ($params) {
  require __DIR__ . "/views/action.php";
});

##################################################
$Router->map("GET", "/error", function () {
  require(__DIR__ . "/views/error.php");
});

$match = $Router->match();

if (is_array($match) && is_callable($match['target'])) {
  call_user_func_array($match['target'], $match['params']);
} else {
  header("HTTP/1.1 404 Not Found");
  require __DIR__ . "/views/error.php";
}
