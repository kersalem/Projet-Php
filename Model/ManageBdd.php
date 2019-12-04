<?php

define( 'DB_NAME', 'db_projetPhp' );
define( 'DB_USER', 'root' );
define( 'DB_PASSWORD', 'root' );
define( 'DB_HOST', 'localhost' );
// connexion à Mysql sans base de données
$pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.'charset=utf8', DB_USER, DB_PASSWORD);

// création de la requête sql
// on teste avant si elle existe ou non (par sécurité)
$requete = "SELECT * From secteur";

// on prépare et on exécute la requête
$test = $pdo->prepare($requete)->execute();