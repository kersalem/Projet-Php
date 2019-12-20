<?php


namespace App\Entity;

require_once('Model/Entity/Structure.php');

class Association extends Structure
{
    /**
     * @var int $nbDonateurs
     */
    private $nbDonateurs;

    /**
     * Association constructor.
     *
     * @param int    $id
     * @param string $nom
     * @param string $rue
     * @param string $cp
     * @param string $ville
     * @param int    $nbDonateurs
     * @param array  $secteurs
     */
    public function __construct(
        int $id = 0,
        string $nom = "",
        string $rue = "",
        string $cp = "",
        string $ville = "",
        int $nbDonateurs = 0,
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
        $this->estAsso     = true;
        $this->nbDonateurs = $nbDonateurs;
    }

    /**
     * @return int
     */
    public function getNbDonateurs(): int
    {
        return $this->nbDonateurs;
    }

    /**
     * @param int $nbDonateurs
     */
    public function setNbDonateurs(int $nbDonateurs): void
    {
        $this->nbDonateurs = $nbDonateurs;
    }

}