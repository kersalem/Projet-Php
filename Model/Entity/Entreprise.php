<?php


namespace App\Entity;

class Entreprise extends Structure
{
    /**
     * @var int
     */
    private $nbActionnaires;

    /**
     * Entreprise constructor.
     *
     * @param int    $id
     * @param string $nom
     * @param string $rue
     * @param string $cp
     * @param string $ville
     * @param int    $nbActionnaires
     * @param array  $secteurs
     */
    public function __construct(
        int $id = 0,
        string $nom =  "",
        string $rue = "",
        string $cp = "",
        string $ville = "",
        int $nbActionnaires = 0,
        array $secteurs = []
    ) {
        parent::__construct(
            $id,
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