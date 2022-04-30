<?php

function myPDO($hostname, $database, $username, $password) {
    try {
        $bdd = new PDO("mysql:host=".$hostname.";dbname=".$database.";charset=utf8","".$username."","".$password."");
        return $bdd;
    } catch (PDOException $e) {
        die("Erreur de connexion à la base de données : " . $e->getMessage());
    }
}

function auth($lvl) {
    if (isset($_SESSION['lvl']) && $_SESSION['lvl'] >= $lvl)
        return true;
    else
        header('Location: https://YassineBenHamdoune.fr/admin-panel');
}


