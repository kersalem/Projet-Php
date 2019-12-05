<?php

define('DB_NAME', 'db_projetPhp');
define('DB_USER', 'pama');
define('DB_PASSWORD', 'pama');
define('DB_HOST', 'localhost');
define('DB_PORT', 3306);
// connexion à Mysql sans base de données
//$dsn = 'mysql:host='.DB_HOST.';port='.DB_PORT.';dbname='.DB_NAME;
//var_dump($dsn);
try {
    $pdo = new PDO(
        'mysql:host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_NAME
        . ';charset=utf8', DB_USER, DB_PASSWORD
    );
} catch (Exception $e) {
    die("Error : " . $e->getMessage());
}

// création de la requête sql
// on teste avant si elle existe ou non (par sécurité)
$requete = "SELECT * From secteur";

// on prépare et on exécute la requête
$test = $pdo->prepare($requete);
$test->execute();
var_dump($test->fetchAll());