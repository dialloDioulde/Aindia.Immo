<?php
// Fonction permettant de se connecter à la Base De Données

function connexionPDO() {
    try {
        $database = new PDO("mysql:host=".HOST_NAME.";dbname=".DATABASE_NAME.";charset=utf8", USER_NAME, PASSWORD);
        $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        //$database->exec("SET CHARACTER SET utf8");

        /*
         $database = new PDO(
            'mysql:host='.HOST_NAME.';dbname='.DATABASE_NAME.'',
            USER_NAME,
            PASSWORD,
            array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
        );
        $database->exec("set names utf8");
         */

        return $database;
    } catch (PDOException $exception) {
        $message = "Message (Erreur de Connexion avec PDO) : ". $exception->getMessage();
        die($message);
    }
}
