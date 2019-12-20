<?php


namespace App\Helpers\View;


use App\Helpers\Router\Router;

class ViewLoader
{
    public function load(string $viewPath, array $params = [])
    {
        foreach ($params as $paramName => $paramValue) {
            ${$paramName} = $paramValue;
        }

        $router = new Router();

        ob_start();
        require(__DIR__.'/../../View/'.$viewPath);
        $view = ob_get_contents();
        ob_end_clean();
        echo $view;
    }
}