<?php


namespace App\Controller;


use App\Entity\Secteur;
use App\Helpers\Controller\AbstractController;
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
        $secteur = $this->secteurManager->findById($id);
        if ($this->formSecteurIsValid()) {
            $secteur->setLibelle($_POST['nomSecteur']);
            $this->secteurManager->update($secteur);
            $this->redirectToRoute('secteur.list');
        } else {
            $this->render('Secteur/edit.php', [
                "titre" => "Modifier le secteur",
                "secteur" => $secteur
            ]);
        }
    }

    public function addAction()
    {
        if ($this->formSecteurIsValid()) {
            $newSecteur = new Secteur(0,$_POST['nomSecteur']);
            $this->secteurManager->insert($newSecteur);
            $this->redirectToRoute('secteur.list');
        } else {
            $this->render('Secteur/edit.php', [
                'titre' => "Créer un secteur",
                'secteur' => null
            ]);
        }
    }

    private function formSecteurIsValid()
    {
        return ( ! empty($_POST['nomSecteur']));
    }
}