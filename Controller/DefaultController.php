<?php


namespace App\Controller;


use App\Helpers\Controller\AbstractController;

class DefaultController extends AbstractController
{
    public function indexAction()
    {
        $this->render("Default/index.php");
    }
}