<?php


namespace App\Helpers\Controller;


class ErrorController extends AbstractController
{
    public function error404()
    {
        http_response_code(404);
        $this->render('Error/404Error.html');
    }
}