<?php


namespace App\Controller;


use App\Entity\Association;
use App\Entity\Entreprise;
use App\Entity\Structure;
use App\Form\StructureForm;
use App\Helpers\Controller\AbstractController;
use App\Helpers\Controller\ErrorController;
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

        $formValues = $form->getFormValues(null);
        $form->setPostValuesInSession();

        if ($form->formIsValid()) {
            if(isset($_POST['estAsso']) && $_POST['estAsso']) {
                $structure = new Association();
            } else {
                $structure = new Entreprise();
            }
            $form->handleForm($structure);

            $this->structureManager->insert($structure);
            $this->redirectToRoute('structure.list');
        } else {
            $this->render('Structure/edit.php', [
                "titre" => "Création d'une structure",
                "structure" => null,
                "secteurs" => $secteurs,
                "edit" => false,
                "formValues" => $formValues
            ]);
        }
    }

    public function editAction(int $id)
    {
        /** @var Structure $structure */
        try {
            $structure = $this->structureManager->findById($id);
        } catch (\Exception $e) {
            $error = new ErrorController();
            $error->error404();
            die();
        }
        $form = new StructureForm();

        $managerSecteur = new SecteurManager();
        $secteurs = $managerSecteur->findAll();

        $formValues = $form->getFormValues($structure);
        $form->setPostValuesInSession();

        if ($form->formIsValid()) {
            $form->handleForm($structure);

            $this->structureManager->update($structure);
            $this->redirectToRoute('structure.list');
        } else {
            $this->render('Structure/edit.php', [
                "titre" => "Modification d'une " . ($structure instanceof Entreprise ? "entreprise" : "association"),
                "structure" => $structure,
                "secteurs" => $secteurs,
                "edit" => true,
                "formValues" => $formValues
            ]);
        }
    }
}