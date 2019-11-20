<?php


namespace App\Controller;


class AdminController
{
    /**
     * @param array $route
     */
    public function get(array $route)
    {
        switch ($route[2]) {
            case "edit":
                $this->editAction($route);
                break;
            case "create":
                $this->createAction();
                break;
            case "delete":
                $this->deleteAction($route);
                break;
            case "list":
                $this->listAction();
                break;
            default:
                $this->error404Action();
                break;
        }
    }

    public function editAction(array $route)
    {
        echo "Page pour editer";
    }

    public function createAction()
    {
        echo "Page pour creer";
    }

    public function deleteAction(array $route)
    {
        echo "Page pour supprimer";
    }

    public function listAction()
    {
        echo "Page pour lister";
    }

    public function error404Action()
    {
        http_response_code(404);
        include('View/Error/404Error.html');
    }
}