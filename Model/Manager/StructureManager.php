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
     * @return Entity|null
     */
    public function findById(int $id): ?Entity
    {
        $stmt = $this->executePrepare("select * from structure where id=:id", ["id" => $id]);
        $structure = $stmt->fetch();
        if (!structure) return null;

        if($structure["ESTASSO"]) {
            $structuresEntities[] = new Association($structure["ID"], $structure["NOM"], $structure["RUE"], $structure["CP"],$structure["VILLE"],[]);
        }
    }

    public function find(): PDOStatement
    {
        $stmt = $this->executePrepare("select * from structure", []);
        return $stmt;
    }

    public function findAll(): array
    {
        $stmt = $this->find();
        $structures = $stmt->fetchAll();

        $structuresEntities = [];

        foreach ($structures as $structure) {

            if($structure["ESTASSO"]) {
                $structuresEntities[] = new Association($structure["ID"], $structure["NOM"], $structure["RUE"], $structure["CP"],$structure["VILLE"],$structure["NB_DONATEURS"],[]);
            } else {
                $structuresEntities[] = new Entreprise($structure["ID"], $structure["NOM"], $structure["RUE"], $structure["CP"],$structure["VILLE"],$structure["NB_ACTIONNAIRES"],[]);

            }
        }
        return $structuresEntities;
    }

    /**
     * @param Entity $e
     * @return PDOStatement
     */
    public function insert(Entity $e): PDOStatement
    {
        $req = "insert into structure(id, nom, rue, cp, ville, secteurs) values (:id, :nom, :rue, :cp, :ville, :secteurs)";
        $params = array("id" => $e->getId(), "nom" => $e->getNom(), "rue" => $e->getRue(), "cp" => $e->getCp(), "ville" => $e->getVille(), "secteurs" => $e->getSecteurs());
        $res = $this->executePrepare($req, $params);
        return $res;
    }
}