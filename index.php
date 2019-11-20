<?php
require('Controller/AdminController.php');

use App\Controller\AdminController;

$adminController = new AdminController();

$route = explode('/', $_SERVER['REQUEST_URI']);

if($route[1] === "admin") {
    $adminController->get($route);
} else {
    http_response_code(404);
    include('View/Error/404Error.html');
}