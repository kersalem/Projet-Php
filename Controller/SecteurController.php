<?php


namespace App\Controller;


use App\Entity\Secteur;
use App\Form\SecteurForm;
use App\Helpers\Controller\AbstractController;
use App\Helpers\Controller\ErrorController;
use App\Manager\SecteurManager;

class SecteurController extends AbstractController
{
    /**
     * @var SecteurManager
     */
    private $secteurManager;

    public function __construct()
    {
        parent::__construct();
        $this->secteurManager = new SecteurManager();
    }

    public function listAction()
    {
        $secteurs = $this->secteurManager->findAll();
        $this->render("Secteur/list.php", [
            "secteurs" => $secteurs
        ]);
    }

    public function deleteAction(int $id)
    {
        $this->secteurManager->delete($id);
        $this->redirectToRoute('secteur.list');
    }

    public function editAction(int $id)
    {
        try {
            $secteur = $this->secteurManager->findById($id);
        } catch (\Exception $e) {
            $error = new ErrorController();
            $error->error404();
            die();
        }
        $form = new SecteurForm();

        $formValues = $form->getFormValues($secteur);
        $form->setPostValuesInSession();

        if ($form->formIsValid()) {
            $secteur->setLibelle($_POST['nomSecteur']);
            $this->secteurManager->update($secteur);
            $this->redirectToRoute('secteur.list');
        } else {
            $this->render('Secteur/edit.php', [
                "titre" => "Modifier le secteur",
                "secteur" => $secteur,
                "formValues" => $formValues
            ]);
        }
    }

    public function addAction()
    {
        $secteur = new Secteur();
        $form = new SecteurForm();

        $formValues = $form->getFormValues(null);
        $form->setPostValuesInSession();
        if ($form->formIsValid()) {
            $newSecteur = new Secteur(0,$_POST['nomSecteur']);
            $this->secteurManager->insert($newSecteur);
            $this->redirectToRoute('secteur.list');
        } else {
            $this->render('Secteur/edit.php', [
                'titre' => "Créer un secteur",
                'secteur' => null,
                'formValues' => $formValues
            ]);
        }
    }
}