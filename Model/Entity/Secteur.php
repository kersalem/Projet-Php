<?php


namespace App\Entity;


class Secteur
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
     * @var array $structures
     */
    private $structures;

    /**
     * SecteurEntity constructor.
     *
     * @param string $libelle
     * @param array  $structures
     */
    public function __construct($libelle, array $structures)
    {
        $this->libelle    = $libelle;
        $this->structures = $structures;
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

    /**
     * @return array
     */
    public function getStructures()
    {
        return $this->structures;
    }

    /**
     * @param array $structures
     */
    public function setStructures($structures)
    {
        $this->structures = $structures;
    }

    /**
     * @param Structure $structure
     */
    public function addStructure($structure)
    {
        $this->structures[] = $structure;
    }
}