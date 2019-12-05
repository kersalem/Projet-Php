<?php


namespace App\Controller;


require_once('Model/Entity/Association.php');
require_once('Model/Entity/Entreprise.php');
require_once('Model/Entity/Secteur.php');
require_once('Controller/ErrorController.php');
require_once('Model/Manager/SecteurManager.php');
require_once('Model/Manager/StructureManager.php');

use App\Entity\Association;
use App\Entity\Entreprise;
use App\Entity\Structure;
use App\Entity\Secteur;
use App\Manager\SecteurManager;
use App\Manager\StructureManager;
use PDO;


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
                        $this->editSecteurAction(intval($route[4]));
                        break;
                    case "create":
                        $this->createSecteurAction();
                        break;
                    case "delete":
                        $this->deleteSecteurAction(intval($route[4]));
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
                $manager = new StructureManager();
                $newStructure = new Association(0,$_POST['nomStructure'], $_POST['$rueStructure'], $_POST['cpStructure'], $_POST['villeStructure'], $_POST['nb_donOrAct'], $_POST['estAsso']);
                $manager->insert($newStructure);
                header('Location: /admin/structure/');
        }
        $secteur = null;
        $titre = "Créer une structure";
        require('View/Admin/editionStructure.php');
    }

    private function deleteStructureAction(array $route)
    {
        // TODO: check if structure exist and delete if exist, else, 404 error
        header('Location: /admin/');
    }

    private function listStructureAction()
    {
        $manager    = new StructureManager();
        $structures = $manager->findAll();
        require('View/Admin/listStructures.php');
    }

    private function editSecteurAction(int $secteurId)
    {
        $manager = new SecteurManager();
        $secteur = $manager->findById($secteurId);
        if ($this->formSecteurIsValid()) {
            $secteur->setLibelle($_POST['nomSecteur']);
            $manager->update($secteur);
            header('Location: /admin/secteur/');
        } else {
            $titre = "Modifier le secteur";
            require('View/Admin/editionSecteur.php');
        }
    }

    private function createSecteurAction()
    {
        if ($this->formSecteurIsValid()) {
            $manager = new SecteurManager();
            $newSecteur = new Secteur(0,$_POST['nomSecteur']);
            $manager->insert($newSecteur);
            header('Location: /admin/secteur/');
        } else {
            $secteur = null;
            $titre = "Créer un secteur";
            require('View/Admin/editionSecteur.php');
        }
    }

    private function deleteSecteurAction(int $secteurId)
    {
        $manager = new SecteurManager();
        $manager->delete($secteurId);
        header('Location: /admin/secteur/');
    }

    private function listSecteurAction()
    {
        $manager  = new SecteurManager();
        $secteurs = $manager->findAll();
        require('View/Admin/listSecteurs.php');
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

    private function formSecteurIsValid()
    {
        return ( ! empty($_POST['nomSecteur']));
    }
}