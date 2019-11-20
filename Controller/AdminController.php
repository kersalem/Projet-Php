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

    }

    public function createAction()
    {

    }

    public function deleteAction(array $route)
    {

    }

    public function listAction()
    {

    }

    public function error404Action()
    {

    }
}