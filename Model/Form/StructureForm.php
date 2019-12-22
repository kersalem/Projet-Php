<?php

namespace App\Form;

use App\Entity\Association;
use App\Entity\Entity;
use App\Entity\Entreprise;
use App\Entity\Structure;
use App\Helpers\Form\AbstractForm;
use App\Manager\SecteurManager;

class StructureForm extends AbstractForm
{
    public function formIsValid(): bool
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
            ! empty($_POST['nbDonOrAct'])
            && strlen($_POST['cpStructure']) === 5
        );
    }

    public function handleForm(Entity $structure)
    {
        $managerSecteur = new SecteurManager();
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
    }

    public function getFormValues($structure): array
    {
        $formValues = [];
        if ($structure instanceof Structure) {
            $formValues['nomStructure'] = $structure->getNom();
            $formValues['rueStructure'] = $structure->getRue();
            $formValues['cpStructure'] = $structure->getCp();
            $formValues['villeStructure'] = $structure->getRue();
            $formValues['secteurs'] = array_map(
                function ($secteur) {
                    return $secteur->getId();
                },
                $structure->getSecteurs()
            );
            if ($structure instanceof Entreprise) {
                $formValues['nbDonOrAct'] = $structure->getNbActionnaires();
            } else {
                $formValues['nbDonOrAct'] = $structure->getNbDonateurs();
            }
        } elseif (!empty($_POST)) {
            foreach ($_POST as $key => $value) {
                $formValues[$key] = $value;
            }
        } else {
            session_start();
            foreach ($_SESSION as $key => $value) {
                $formValues[$key] = $value;
            }
        }

        return $formValues;
    }
}