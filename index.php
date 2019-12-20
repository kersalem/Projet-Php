<?php

require_once('./vendor/autoload.php');

use App\Helpers\Router\Router;

$router = new Router();

try {
    $router->handleRequest($_SERVER['REQUEST_URI'], $_GET);
} catch (ReflectionException $e) {
    error_log($e->getMessage()."\n".$e->getTraceAsString());
}