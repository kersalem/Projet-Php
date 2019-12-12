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
                        $this->editStructureAction(intval($route[4]));
                        break;
                    case "create":
                        $this->createStructureAction();
                        break;
                    case "delete":
                        $this->deleteStructureAction(intval($route[4]));
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

    private function editStructureAction(int $structureId)
    {
        $manager = new StructureManager();
        $structure = $manager->findById($structureId);
        if ($this->formStructureIsValid()) {

            $structure->setNom($_POST['nomStrucutre']);
            $structure->setRue($_POST['rueStructure']);
            $structure->setCp($_POST['cpStructure']);
            $structure->setVille($_POST['villeStructure']);

            if($_POST['estAsso']) {
                $structure->setNbDonateurs($_POST['nbDonOrAct']);
            } else {
                $structure->setNbActionnaires($_POST['nbDonOrAct']);
            }

            //$structure->setSecteurs([]);

            $manager->update($structure);

            header('Location: /admin/');

        } else {
            $titre = "Modifier une structure";
            include('View/Admin/editionStructure.php');
        }
    }

    private function createStructureAction()
    {
        if ($this->formStructureIsValid()) {

            $manager = new StructureManager();

            if($_POST['estAsso']){
                $newStructure = new Association(0,$_POST['nomStructure'], $_POST['rueStructure'], $_POST['cpStructure'], $_POST['villeStructure'], $_POST['nbDonOrAct'], []);

            } else {
                $newStructure = new Entreprise(0,$_POST['nomStructure'], $_POST['rueStructure'], $_POST['cpStructure'], $_POST['villeStructure'], $_POST['nbDonOrAct'], []);
            }

            $manager->insert($newStructure);
            header('Location: /admin/structure/');
        } else {
            $secteur = null;
            $titre = "Créer une structure";
            require('View/Admin/editionStructure.php');
        }
    }

    private function deleteStructureAction(int $structureId)
    {
        if($structureId){
            $manager = new StructureManager();
            $manager->delete($structureId);
            header('Location: /admin/structure');
        } else {
            $error = error404();
        }
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
        if($secteurId){
        $manager = new SecteurManager();
        $manager->delete($secteurId);
        header('Location: /admin/secteur/');
    } else {
            $error = error404();
}
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
            ! empty($_POST['nbDonOrAct'])
            && strlen($_POST['cpStructure']) === 5
        );
    }

    private function formSecteurIsValid()
    {
        return ( ! empty($_POST['nomSecteur']));
    }
}