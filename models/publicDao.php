<?php
// Importation des Fichiers
require_once "config/config.php";
require_once "pdo.php";


function getPublicOfOffer($publicId) {
    $database = connexionPDO();
    $query = 'SELECT name_public FROM offers_public WHERE id_public = :publicId';
    $request = $database->prepare($query);
    $request->bindValue(":publicId", $publicId, PDO::PARAM_INT);
    $request->execute();
    $publicOffer = $request->fetch(PDO::FETCH_ASSOC);
    $request->closeCursor();
    return $publicOffer;
}
