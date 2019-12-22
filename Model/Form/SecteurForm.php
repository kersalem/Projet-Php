<?php


namespace App\Form;


use App\Entity\Entity;
use App\Entity\Secteur;
use App\Helpers\Form\AbstractForm;

class SecteurForm extends AbstractForm
{
    public function formIsValid(): bool
    {
        return (
            ! empty($_POST['nomSecteur'])
        );
    }

    public function handleForm(Entity $secteur)
    {
        $secteur->setLibelle($_POST['nomSecteur']);
    }

    public function getFormValues($secteur): array
    {
        $formValues = [];
        if ($secteur instanceof Secteur) {
            $formValues['nomSecteur'] = $secteur->getLibelle();
        } elseif (!empty($_POST)) {
            $formValues['nomSecteur'] = $_POST['nomSecteur'];
        } else {
            session_start();
            $formValues['nomSecteur'] = $_SESSION['nomSecteur'];
        }
        return $formValues;
    }
}