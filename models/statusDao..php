<?php
// Importation des Fichiers
require_once "config/config.php";
require_once "pdo.php";


function getStatusList(): array
{
    $database = connexionPDO();
    $query = 'SELECT * FROM approval';
    $request = $database->prepare($query);
    $request->execute();
    $statusList = $request->fetchAll(PDO::FETCH_ASSOC);
    $request->closeCursor();
    return $statusList;
}

//****************************************
function getStatusOfOfferById($offerId) {
    $database = connexionPDO();
    $query = 'SELECT a.id_approval, a.name_approval FROM approval a
        INNER JOIN offers_approval oa on a.id_approval = oa.id_approval
        INNER JOIN offers o on o.id_offer = oa.id_offer
        WHERE o.id_offer = :id_offer
    ';
    $request = $database->prepare($query);
    $request->bindValue(":id_offer", $offerId, PDO::PARAM_INT);
    $request->execute();
    $status = $request->fetch(PDO::FETCH_ASSOC);
    $request->closeCursor();
    return $status;

}

function getStatusByName($statusName) {
    $database = connexionPDO();
    $query = 'SELECT name_approval FROM offers_approval WHERE id_approval = :id_approval';
    $request = $database->prepare($query);
    $request->bindValue(":id_approval", $statusName, PDO::PARAM_INT);
    $request->execute();
    $status = $request->fetch(PDO::FETCH_ASSOC);
    $request->closeCursor();
    return $status;
}
