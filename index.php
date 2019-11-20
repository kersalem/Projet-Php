<?php
require_once('Controller/AdminController.php');
require_once('Controller/ErrorController.php');

use App\Controller\AdminController;
use App\Controller\ErrorController;

$error = new ErrorController();
$adminController = new AdminController();

$route = explode('/', $_SERVER['REQUEST_URI']);

if($route[1] === "admin") {
    $adminController->get($route);
} else {
    $error->error404();
}