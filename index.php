<?php

session_start();


if ($_SERVER['SERVER_NAME'] !== 'localhost') {
   if (!(isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on' ||
      $_SERVER['HTTPS'] == 1) ||
      isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
      $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) {
      $redirect = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
      header('HTTP/1.1 301 Moved Permanently');
      header('Location: ' . $redirect);
      exit();
   }
}

ini_set('display_errors', 1);
error_reporting(E_ALL);

//define timezone to america_saopaulo
date_default_timezone_set('America/Sao_Paulo');

require_once "core/vendor/autoload.php";

require_once "core/Base.php";

$app = new Base();
define("DB_HOST", $app->ini('dbhost'));
define("DB_USER", $app->ini('dbuser'));
define("DB_PASS", $app->ini('dbpass'));
define("DB_NAME", $app->ini('dbname'));

require_once "core/Controller.php";

$app->error();
$app->run();
