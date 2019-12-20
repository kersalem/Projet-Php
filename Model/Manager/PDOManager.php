<?php

namespace App\Manager;

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
    private const PARAMETER_PATH = __DIR__.'/../../Conf/parameters.yml';
    /**
     * Manager constructor
     */
    public function __construct()
    {
        $parameters = yaml_parse_file(self::PARAMETER_PATH);
        $this->host         = $parameters['database']["host"];
        $this->db           = $parameters['database']["database"];
        $this->encoding     = $parameters['database']["encoding"];
        $this->user         = $parameters['database']["username"];
        $this->pass         = $parameters['database']["password"];
        $this->pdoErrorMode = constant('\PDO::'.$parameters['database']["error_mode"]);
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