<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);
require '../vendor/autoload.php';
require '../app/Config.php';
require '../app/routing.php';
require '../app/Router.php';
$router = new Router($routing);
$router->handleRequest();

