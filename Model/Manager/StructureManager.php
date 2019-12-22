<?php


namespace App\Manager;

use App\Entity\Entity;
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
            "SELECT structure.*, group_concat(ss.ID_SECTEUR) as ID_SECTEUR FROM structure
                LEFT JOIN secteurs_structures ss ON structure.ID = ss.ID_STRUCTURE
                WHERE structure.id = :id
                GROUP BY structure.ID",
            ["id" => $id]
        );
        $structure = $stmt->fetch();
        if ( ! $structure) {
            throw new \Exception('Cette structure n\'existe pas');
        }

        $secteurManager = new SecteurManager();
        $secteurs = [];

        if ($structure['ID_SECTEUR'] !== null) {
            foreach (explode(',', $structure['ID_SECTEUR']) as $idSecteur) {
                $secteurs[] = $secteurManager->findById(intval($idSecteur));
            }
        }

        if ($structure["ESTASSO"]) {
            return new Association(
                $structure["ID"],
                $structure["NOM"],
                $structure["RUE"],
                $structure["CP"],
                $structure["VILLE"],
                $structure["NB_DONATEURS"],
                $secteurs
            );
        } else {
            return new Entreprise(
                $structure["ID"],
                $structure["NOM"],
                $structure["RUE"],
                $structure["CP"],
                $structure["VILLE"],
                $structure["NB_ACTIONNAIRES"],
                $secteurs
            );
        }
    }

    public function find(): PDOStatement
    {
        $stmt = $this->executePrepare("
            SELECT structure.*, group_concat(ss.ID_SECTEUR) as ID_SECTEUR FROM structure
            LEFT JOIN secteurs_structures ss ON structure.ID = ss.ID_STRUCTURE GROUP BY structure.ID
        ", []);

        return $stmt;
    }

    public function findAll(): array
    {
        $stmt       = $this->find();
        $structures = $stmt->fetchAll();

        $structuresEntities = [];

        $secteurManager = new SecteurManager();

        foreach ($structures as $structure) {
            $secteurs = [];
            if ($structure['ID_SECTEUR'] !== null) {
                foreach (explode(',', $structure['ID_SECTEUR']) as $idSecteur) {
                    $secteurs[] = $secteurManager->findById(intval($idSecteur));
                }
            }
            if ($structure["ESTASSO"]) {
                $structuresEntities[] = new Association(
                    $structure["ID"],
                    $structure["NOM"],
                    $structure["RUE"],
                    $structure["CP"],
                    $structure["VILLE"],
                    $structure["NB_DONATEURS"],
                    $secteurs
                );
            } else {
                $structuresEntities[] = new Entreprise(
                    $structure["ID"],
                    $structure["NOM"],
                    $structure["RUE"],
                    $structure["CP"],
                    $structure["VILLE"],
                    $structure["NB_ACTIONNAIRES"],
                    $secteurs
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
            $params = [
                "nom"            => $e->getNom(),
                "rue"            => $e->getRue(),
                "cp"             => $e->getCp(),
                "ville"          => $e->getVille(),
                "nb_actionnaires" => $e->getNbActionnaires()
            ];
            $res    = $this->executePrepare($req, $params);
        } elseif ($e instanceOf Association) {
            $req
                    = "INSERT INTO structure(nom, rue, cp, ville, nb_donateurs, estasso, nb_actionnaires) VALUES (:nom, :rue, :cp, :ville, :nb_donateurs, true, null)";
            $params = [
                "nom"         => $e->getNom(),
                "rue"         => $e->getRue(),
                "cp"          => $e->getCp(),
                "ville"       => $e->getVille(),
                "nb_donateurs" => $e->getNbDonateurs()
            ];
            $res    = $this->executePrepare($req, $params);
        }
        $this->insertSecteursInStructure($this->getLastId(), $e->getSecteurs());
        return $res;
    }

    public function delete(int $id): PDOStatement
    {
        $this->deleteAllAssociationWithSecteur($id);
        $req    = 'DELETE FROM structure 
                    WHERE id=:id';
        $params = ["id" => $id];

        return $this->executePrepare($req, $params);
    }


    public function update(Entity $e): PDOStatement
    {
        if ($e instanceOf Entreprise) {
            $req
                    = "UPDATE  structure 
                        SET 
                                NOM = :nom,
                                RUE = :rue, 
                                CP = :cp, 
                                VILLE = :ville,
                                NB_ACTIONNAIRES = :nb_actionnaires
                        WHERE   ID = :id";
            $params = [
                "nom"            => $e->getNom(),
                "rue"            => $e->getRue(),
                "cp"             => $e->getCp(),
                "ville"          => $e->getVille(),
                "nb_actionnaires" => $e->getNbActionnaires(),
                "id"             => $e->getId(),
            ];
        } elseif ($e instanceOf Association) {
            $req
                    = "UPDATE structure
                        SET
                                NOM = :nom, 
                                RUE = :rue, 
                                CP = :cp, 
                                VILLE = :ville, 
                                NB_DONATEURS = :nb_donateurs
                        WHERE   id= :id";
            $params = [
                "nom"         => $e->getNom(),
                "rue"         => $e->getRue(),
                "cp"          => $e->getCp(),
                "ville"       => $e->getVille(),
                "nb_donateurs" => $e->getNbDonateurs(),
                "id"          => $e->getId(),
            ];
        }
        $res = $this->executePrepare($req, $params);
        $this->insertSecteursInStructure($e->getId(), $e->getSecteurs());
        return $res;
    }

    private function insertSecteursInStructure(int $idStructure, array $secteurs)
    {
        $this->deleteAllAssociationWithSecteur($idStructure);
        foreach ($secteurs as $secteur) {
            $req = "INSERT INTO secteurs_structures(ID_SECTEUR, ID_STRUCTURE) VALUES (:idSecteur, :idStructure)";
            $params = [
                "idSecteur" => $secteur->getId(),
                "idStructure" => $idStructure
            ];
            $this->executePrepare($req, $params);
        }
    }

    private function deleteAllAssociationWithSecteur(int $idStructure)
    {
        $req = "DELETE FROM secteurs_structures WHERE ID_STRUCTURE = :idStructure";
        $params = ["idStructure" => $idStructure];
        $this->executePrepare($req, $params);
    }

    private function getLastId(): int
    {
        $stmt = $this->executePrepare("SELECT id FROM structure ORDER BY id DESC LIMIT 0, 1", []);
        $res = $stmt->fetch();
        return intval($res['id']);
    }
}