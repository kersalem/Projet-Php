<?php


namespace App\Manager;

require_once('Model/Entity/Structure.php');
require_once('PDOManager.php');
require_once('Model/Entity/Association.php');
require_once('Model/Entity/Entreprise.php');

use App\Entity\Entity;
use App\Entity\Structure;
use \PDOStatement;
use App\Entity\Association;
use App\Entity\Entreprise;

class StructureManager extends PDOManager
{
    /**
     * @param int $id
     *
     * @return Entity|null
     */
    public function findById(int $id): ?Entity
    {
        $stmt      = $this->executePrepare(
            "SELECT * FROM structure WHERE id=:id",
            ["id" => $id]
        );
        $structure = $stmt->fetch();
        if ( ! structure) {
            return null;
        }

        if ($structure["ESTASSO"]) {
            return new Association(
                $structure["ID"],
                $structure["NOM"],
                $structure["RUE"],
                $structure["CP"],
                $structure["VILLE"],
                $structure["NB_DONATEURS"],
                []
            );
        } else {
            return new Entreprise(
                $structure["ID"],
                $structure["NOM"],
                $structure["RUE"],
                $structure["CP"],
                $structure["VILLE"],
                $structure["NB_ACTIONNAIRES"],
                []
            );
        }
    }

    public function find(): PDOStatement
    {
        $stmt = $this->executePrepare("SELECT * FROM structure", []);

        return $stmt;
    }

    public function findAll(): array
    {
        $stmt       = $this->find();
        $structures = $stmt->fetchAll();

        $structuresEntities = [];

        foreach ($structures as $structure) {
            if ($structure["ESTASSO"]) {
                $structuresEntities[] = new Association(
                    $structure["ID"],
                    $structure["NOM"],
                    $structure["RUE"],
                    $structure["CP"],
                    $structure["VILLE"],
                    $structure["NB_DONATEURS"],
                    []
                );
            } else {
                $structuresEntities[] = new Entreprise(
                    $structure["ID"],
                    $structure["NOM"],
                    $structure["RUE"],
                    $structure["CP"],
                    $structure["VILLE"],
                    $structure["NB_ACTIONNAIRES"],
                    []
                );
            }
        }

        return $structuresEntities;
    }

    /**
     * @param Entity $e
     *
     * @return PDOStatement
     */
    public function insert(Entity $e): PDOStatement
    {
        if ($e instanceOf Entreprise) {
            $req
                    = "INSERT INTO structure(nom, rue, cp, ville, nb_actionnaires, estasso, nb_donateurs) VALUES (:nom, :rue, :cp, :ville, :nb_actionnaires, false, null)";
            $params = array(
                "nom"            => $e->getNom(),
                "rue"            => $e->getRue(),
                "cp"             => $e->getCp(),
                "ville"          => $e->getVille(),
                "nbActionnaires" => $e->getNbActionnaires(),
            );
            $res    = $this->executePrepare($req, $params);

            return $res;
        } elseif ($e instanceOf Association) {
            $req
                    = "INSERT INTO structure(nom, rue, cp, ville, nb_donateurs, estasso, nb_actionnaires) VALUES (:nom, :rue, :cp, :ville, :nb_donateurs, true, null)";
            $params = array(
                "nom"         => $e->getNom(),
                "rue"         => $e->getRue(),
                "cp"          => $e->getCp(),
                "ville"       => $e->getVille(),
                "nbDonateurs" => $e->getNbDonateurs(),
            );
            $res    = $this->executePrepare($req, $params);

            return $res;
        }
    }

    /*    public function delete(Entity $e, $id): PDOStatement {

            if($e instanceOf Entreprise) {
                $req = 'DELETE * from structure WHERE id=$id';
                $res = $this->executePrepare($req);
                return $res;
            }
        } */


    public function update(Entity $e): PDOStatement
    {
        if ($e instanceOf Entreprise) {
            $req
                    = "UPDATE structure(nom, rue, cp, ville, nb_actionnaires) SET (:nom, :rue, :cp, :ville, :nb_actionnaires) WHERE id="
                      . $e->getId();
            $params = array(
                "nom"            => $e->getNom(),
                "rue"            => $e->getRue(),
                "cp"             => $e->getCp(),
                "ville"          => $e->getVille(),
                "nbActionnaires" => $e->getNbActionnaires(),
            );
            $res    = $this->executePrepare($req, $params);

            return $res;
        } elseif ($e instanceOf Association) {
            $req
                    = "UPDATE structure(nom, rue, cp, ville, nb_donateurs) SET (:nom, :rue, :cp, :ville, :nb_donateurs) WHERE id="
                      . $e->getId();
            $params = array(
                "nom"         => $e->getNom(),
                "rue"         => $e->getRue(),
                "cp"          => $e->getCp(),
                "ville"       => $e->getVille(),
                "nbDonateurs" => $e->getNbDonateurs(),
            );
            $res    = $this->executePrepare($req, $params);

            return $res;
        }
    }
}