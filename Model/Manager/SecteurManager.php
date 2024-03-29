<?php


namespace App\Manager;

use App\Entity\Entity;
use App\Entity\Secteur;
use \PDOStatement;

class SecteurManager extends PDOManager
{
    /**
     * @param int $id
     *
     * @return Entity|null
     * @throws \Exception
     */
    public function findById(int $id): ?Entity
    {
        $stmt = $this->executePrepare("SELECT * FROM secteur WHERE id=:id", ["id" => $id]);
        $secteur = $stmt->fetch();
        if (!$secteur) {
            throw new \Exception('Le secteur n\'existe pas');
        }
        return new Secteur($secteur["ID"], $secteur["LIBELLE"]);
    }

    public function find(): PDOStatement
    {
        $stmt = $this->executePrepare("SELECT * FROM secteur", []);
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
        $req = "INSERT INTO secteur(libelle) VALUE (:libelle)";
        $params = array("libelle" => $e->getLibelle());
        $res = $this->executePrepare($req, $params);
        return $res;
    }

    public function delete(int $id): PDOStatement
    {
        $req    = 'DELETE FROM secteur 
                    WHERE id=:id';
        $params = ["id" => $id];

        return $this->executePrepare($req, $params);
    }

    public function update(Entity $e): PDOStatement
    {
        $req = "UPDATE secteur SET libelle = :libelle WHERE id = :id";
        $params = ["libelle" => $e->getLibelle(), "id" => $e->getId()];
        $res = $this->executePrepare($req, $params);
        return $res;
    }
}