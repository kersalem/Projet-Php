<?php


namespace App\Controller;


class ErrorController
{
    public function error404()
    {
        http_response_code(404);
        include('View/Error/404Error.html');
    }
}