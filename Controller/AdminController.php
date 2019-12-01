<?php


namespace App\Controller;


require_once('Model/Entity/Secteur.php');
require_once('Controller/ErrorController.php');

use App\Entity\Structure;
use App\Entity\Secteur;


class AdminController
{
    /**
     * @var ErrorController $error
     */
    private $error;

    public function __construct()
    {
        $this->error = new ErrorController();
    }

    /**
     * @param array $route
     */
    public function redirectToAction(array $route)
    {
        switch ($route[2]) {
            case "":
                $this->listStructureAction();
                break;
            case "structure":
                switch ($route[3]) {
                    case "edit":
                        $this->editStructureAction($route);
                        break;
                    case "create":
                        $this->createStructureAction();
                        break;
                    case "delete":
                        $this->deleteStructureAction($route);
                        break;
                    case "":
                        $this->listStructureAction();
                        break;
                    default:
                        $this->error->error404();
                        break;
                }
                break;
            case "secteur":
                switch ($route[3]) {
                    case "edit":
                        $this->editSecteurAction($route);
                        break;
                    case "create":
                        $this->createSecteurAction();
                        break;
                    case "delete":
                        $this->deleteSecteurAction($route);
                        break;
                    case "":
                        $this->listSecteurAction();
                        break;
                    default:
                        $this->error->error404();
                        break;
                }
                break;
            default:
                $this->error->error404();
                break;
        }
    }

    private function editStructureAction(array $route)
    {
        if ($this->formStructureIsValid()) {
            header('Location: /admin/');
            // TODO:persist structure
        } else {
            $titre = "Modifier une structure";
            include('View/Admin/edtionStructure.php');
        }
    }

    private function createStructureAction()
    {
        if ($this->formStructureIsValid()) {
            header('Location: /admin/');
            // TODO:persist structure
        } else {
            $titre = "Créer une structure";
            include('View/Admin/edtionStructure.php');
        }
    }

    private function deleteStructureAction(array $route)
    {
        // TODO: check if structure exist and delete if exist, else, 404 error
        header('Location: /admin/');
    }

    private function listStructureAction()
    {
        include ('View/Admin/listStructures.php');
    }

    private function editSecteurAction(array $route)
    {
    }

    private function createSecteurAction()
    {
    }

    private function deleteSecteurAction(array $route)
    {
    }

    private function listSecteurAction()
    {
    }

    private function formStructureIsValid()
    {
        return (
            ! empty($_POST['nomStructure'])
            &&
            ! empty($_POST['rueStructure'])
            &&
            ! empty($_POST['cpStructure'])
            &&
            ! empty($_POST['villeStructure'])
            &&
            //!empty()
            ! empty($_POST['nbDonnateurs'])
            &&
            ! empty($_POST['nbActionnaires'])
            && strlen($_POST['cpStructure']) === 5
        );
    }
}