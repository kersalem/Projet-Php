<?php

namespace App\Manager;

require_once(__DIR__ . '/../../conf/config.php');

use App\Entity\Entity;
use \PDO;
use \PDOStatement;
use \PDOException;

abstract class PDOManager
{
    /*private string $host, $db, $encoding, $user, $pass;
    private int $pdoErrorMode;*/
    private $host, $db, $encoding, $user, $pass;
    private $pdoErrorMode;

    /**
     * Manager constructor
     */
    public function __construct()
    {
        $this->host         = $GLOBALS["host"];
        $this->db           = $GLOBALS["db"];
        $this->encoding     = $GLOBALS["encoding"];
        $this->user         = $GLOBALS["user"];
        $this->pass         = $GLOBALS["pass"];
        $this->pdoErrorMode = $GLOBALS["pdoErrorMode"];
    }

    protected function dbConnect(): PDO
    {
        $conn = new PDO(
            "mysql:host=$this->host;dbname=$this->db;charset=$this->encoding",
            $this->user,
            $this->pass
        );
        $conn->setAttribute(PDO::ATTR_ERRMODE, $this->pdoErrorMode);

        return $conn;
    }

    protected function executePrepare(string $req, array $params): PDOStatement
    {
        $conn = null;
        try {
            $conn = $this->dbConnect();
            $stmt = $conn->prepare($req);
            $res  = $stmt->execute($params);

            return $stmt;
        } catch (PDOException $ex) {
            throw $ex;
        } finally {
            if ($conn != null) {
                $conn = null;
            }
        }
    }

    public abstract function findById(int $id): ?Entity;

    public abstract function find(): PDOStatement;

    public abstract function findAll(): array;

    public abstract function insert(Entity $e): PDOStatement;

    public abstract function delete(int $id): PDOStatement;

    public abstract function update(Entity $e): PDOStatement;
}