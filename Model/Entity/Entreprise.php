<?php


namespace App\Entity;

require_once('Model/Entity/Structure.php');

class Entreprise extends Structure
{
    public function __construct(
        $nom,
        $rue,
        $cp,
        $ville,
        $nbDonateurs,
        $nbActionnaires,
        $secteurs
    ) {
        parent::__construct(
            $nom,
            $rue,
            $cp,
            $ville,
            $nbDonateurs,
            $nbActionnaires,
            $secteurs
        );
        $this->estAsso = false;
    }
}