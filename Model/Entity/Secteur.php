<?php


namespace App\Entity;

class Secteur extends Entity
{
    /**
     * @var int $id
     */
    private $id;

    /**
     * @var string $libelle
     */
    private $libelle;

    /**
     * SecteurEntity constructor.
     *
     * @param int    $id
     * @param string $libelle
     */
    public function __construct(int $id, string $libelle)
    {
        $this->id      = $id;
        $this->libelle = $libelle;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * @param string $libelle
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;
    }
}