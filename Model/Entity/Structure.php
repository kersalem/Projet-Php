<?php


namespace App\Entity;

abstract class Structure extends Entity
{
    /**
     * @var int $id
     */
    private $id;

    /**
     * @var string $nom
     */
    private $nom;

    /**
     * @var string $rue
     */
    private $rue;

    /**
     * @var string $cp
     */
    private $cp;

    /**
     * @var string $ville
     */
    private $ville;

    /**
     * @var boolean $estAsso
     */
    protected $estAsso;

    /**
     * @var array $secteurs
     */
    private $secteurs;

    /**
     * StructureEntity constructor.
     *
     * @param int    $id
     * @param string $nom
     * @param string $rue
     * @param string $cp
     * @param string $ville
     * @param array  $secteurs
     */
    public function __construct(
        int $id,
        string $nom,
        string $rue,
        string $cp,
        string $ville,
        array $secteurs
    ) {
        $this->id       = $id;
        $this->nom      = $nom;
        $this->rue      = $rue;
        $this->cp       = $cp;
        $this->ville    = $ville;
        $this->secteurs = $secteurs;
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
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return string
     */
    public function getRue()
    {
        return $this->rue;
    }

    /**
     * @param string $rue
     */
    public function setRue($rue)
    {
        $this->rue = $rue;
    }

    /**
     * @return string
     */
    public function getCp()
    {
        return $this->cp;
    }

    /**
     * @param string $cp
     */
    public function setCp($cp)
    {
        $this->cp = $cp;
    }

    /**
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * @param string $ville
     */
    public function setVille($ville)
    {
        $this->ville = $ville;
    }

    /**
     * @return bool
     */
    public function isEstAsso()
    {
        return $this->estAsso;
    }

    /**
     * @return array
     */
    public function getSecteurs()
    {
        return $this->secteurs;
    }

    /**
     * @param secteur[] $secteurs
     */
    public function setSecteurs($secteurs)
    {
        $this->secteurs = $secteurs;
    }

    /**
     * @param Secteur $secteur
     */
    public function addSecteur($secteur)
    {
        $this->secteurs[] = $secteur;
    }

}