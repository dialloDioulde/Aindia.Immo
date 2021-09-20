<?php
// Importation des Fichiers
require_once "config/config.php";
require_once "pdo.php";


function getCategoryOfOffer($categoryId) {
    $database = connexionPDO();
    $query = 'SELECT name_category FROM offers_categories WHERE id_category = :categoryId';
    $request = $database->prepare($query);
    $request->bindValue(":categoryId", $categoryId, PDO::PARAM_INT);
    $request->execute();
    $categoryOffer = $request->fetch(PDO::FETCH_ASSOC);
    $request->closeCursor();
    return $categoryOffer;
}
