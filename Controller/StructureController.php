<?php


namespace App\Controller;


use App\Entity\Association;
use App\Entity\Entreprise;
use App\Entity\Structure;
use App\Form\StructureForm;
use App\Helpers\Controller\AbstractController;
use App\Manager\SecteurManager;
use App\Manager\StructureManager;

class StructureController extends AbstractController
{
    /**
     * @var StructureManager
     */
    private $structureManager;

    public function __construct()
    {
        parent::__construct();
        $this->structureManager = new StructureManager();
    }

    public function listAction()
    {
        $structures = $this->structureManager->findAll();
        $this->render('Structure/list.php', [
            'structures' => $structures
        ]);
    }

    public function deleteAction(int $id)
    {
        $this->structureManager->delete($id);
        $this->redirectToRoute('structure.list');
    }

    public function addAction()
    {
        $form = new StructureForm();

        $managerSecteur = new SecteurManager();
        $secteurs = $managerSecteur->findAll();

        if ($form->formIsValid()) {
            $secteursInStructure = [];
            foreach($_POST['secteurs'] as $secteurId) {
                $secteursInStructure[] = $managerSecteur->findById(intval($secteurId));
            }

            if(isset($_POST['estAsso']) && $_POST['estAsso']) {
                $structure = new Association();
                $structure->setNbDonateurs($_POST['nbDonOrAct']);
            } else {
                $structure = new Entreprise();
                $structure->setNbActionnaires($_POST['nbDonOrAct']);
            }

            $structure->setNom($_POST['nomStructure']);
            $structure->setRue($_POST['rueStructure']);
            $structure->setCp($_POST['cpStructure']);
            $structure->setVille($_POST['villeStructure']);
            $structure->setSecteurs($secteursInStructure);


            $this->structureManager->insert($structure);
            $this->redirectToRoute('structure.list');
        } else {
            $this->render('Structure/edit.php', [
                "titre" => "Création d'une structure",
                "structure" => null,
                "secteurs" => $secteurs,
                "edit" => false
            ]);
        }
    }

    public function editAction(int $id)
    {
        /** @var Structure $structure */
        $structure = $this->structureManager->findById($id);
        $form = new StructureForm();

        $managerSecteur = new SecteurManager();
        $secteurs = $managerSecteur->findAll();

        if ($form->formIsValid()) {
            $secteursInStructure = [];
            foreach($_POST['secteurs'] as $secteurId) {
                $secteursInStructure[] = $managerSecteur->findById(intval($secteurId));
            }

            $structure->setNom($_POST['nomStructure']);
            $structure->setRue($_POST['rueStructure']);
            $structure->setCp($_POST['cpStructure']);
            $structure->setVille($_POST['villeStructure']);
            $structure->setSecteurs($secteursInStructure);

            if($structure instanceof Association) {
                $structure->setNbDonateurs($_POST['nbDonOrAct']);
            } else {
                $structure->setNbActionnaires($_POST['nbDonOrAct']);
            }

            $this->structureManager->update($structure);
            $this->redirectToRoute('structure.list');
        } else {
            $this->render('Structure/edit.php', [
                "titre" => "Modification d'une " . ($structure instanceof Entreprise ? "entreprise" : "association"),
                "structure" => $structure,
                "secteurs" => $secteurs,
                "edit" => true
            ]);
        }
    }
}