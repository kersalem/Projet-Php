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
     * @param string $nom
     * @param string $rue
     * @param int    $cp
     * @param string $ville
     * @param int    $nbDonateurs
     * @param array  $secteurs
     */
    public function __construct(
        string $nom,
        string $rue,
        int $cp,
        string $ville,
        int $nbDonateurs,
        array $secteurs
    ) {
        parent::__construct(
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