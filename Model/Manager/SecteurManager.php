<?php


namespace App\Manager;

require_once('Model/Entity/Secteur.php');
require_once('PDOManager.php');

use App\Entity\Entity;
use App\Entity\Secteur;
use \PDOStatement;

class SecteurManager extends PDOManager
{
    /**
     * @param int $id
     * @return Entity|null
     */
    public function findById(int $id): ?Entity
    {
        $stmt = $this->executePrepare("select * from secteur where id=:id", ["id" => $id]);
        $secteur = $stmt->fetch();
        if (!$secteur) return null;
        return new Secteur($secteur["ID"], $secteur["LIBELLE"]);
    }

    public function find(): PDOStatement
    {
        $stmt = $this->executePrepare("select * from secteur", []);
        return $stmt;
    }

    public function findAll(): array
    {
        $stmt = $this->find();
        $secteurs = $stmt->fetchAll();

        $secteursEntities = [];
        foreach ($secteurs as $secteur) {
            $secteursEntities[] = new Secteur($secteur["ID"], $secteur["LIBELLE"]);
        }
        return $secteursEntities;
    }

    /**
     * @param Entity $e
     * @return PDOStatement
     */
    public function insert(Entity $e): PDOStatement
    {
        $req = "insert into secteur(libelle) values (:libelle)";
        $params = array("libelle" => $e->getLibelle());
        $res = $this->executePrepare($req, $params);
        return $res;
    }
}