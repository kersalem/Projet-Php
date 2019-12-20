<?php


namespace App\Helpers\Controller;


use App\Helpers\Router\Router;
use App\Helpers\View\ViewLoader;

class AbstractController
{
    /**
     * @var ViewLoader
     */
    private $view_loader;

    public function __construct()
    {
        $this->view_loader = new ViewLoader();
    }

    protected function render(string $viewPath, array $params = [])
    {
        $this->view_loader->load($viewPath, $params);
    }

    /**
     * @param string $routeName
     * @param array  $params
     */
    protected function redirectToRoute(string $routeName, array $params = [])
    {
        $router = new Router();
        $router->redirectToRoute($routeName, $params);
    }
}