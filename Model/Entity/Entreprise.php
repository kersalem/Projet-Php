<?php


namespace App\Entity;

require_once('Model/Entity/Structure.php');

class Entreprise extends Structure
{
    /**
     * @var int
     */
    private $nbActionnaires;

    /**
     * Entreprise constructor.
     *
     * @param string $nom
     * @param string $rue
     * @param int    $cp
     * @param string $ville
     * @param int    $nbActionnaires
     * @param array  $secteurs
     */
    public function __construct(
        string $nom,
        string $rue,
        int $cp,
        string $ville,
        int $nbActionnaires,
        array $secteurs
    ) {
        parent::__construct(
            $nom,
            $rue,
            $cp,
            $ville,
            $secteurs
        );
        $this->nbActionnaires = $nbActionnaires;
        $this->estAsso        = false;
    }

    /**
     * @return int
     */
    public function getNbActionnaires(): int
    {
        return $this->nbActionnaires;
    }

    /**
     * @param int $nbActionnaires
     */
    public function setNbActionnaires(int $nbActionnaires): void
    {
        $this->nbActionnaires = $nbActionnaires;
    }


}