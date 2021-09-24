<?php

// Importation des Fichiers
require_once "config/config.php";
require_once "pdo.php";


// Enregistrement de l'image en Base De Données
function insertImageToDatabase($imageName,$imageUrl){
    $database = connexionPDO();
    $query = '
    INSERT INTO images (name_image, url_image) values(:imageName, :imageUrl)
    ';
    $request = $database->prepare($query);
    $request->bindValue(":imageName",$imageName,PDO::PARAM_STR);
    $request->bindValue(":imageUrl",$imageUrl,PDO::PARAM_STR);
    $request->execute();
    $result = $database->lastInsertId();
    $request->closeCursor();
    return $result;
}


// Association de l'ofrre avec les photos ajoutées
function linkOfferWithPhotos($imageId,$offerId){
    $database = connexionPDO();
    $query = '
    INSERT INTO offers_images (id_image, id_offer) values(:imageId, :offerId)
    ';
    $request = $database->prepare($query);
    $request->bindValue(":imageId",$imageId,PDO::PARAM_INT);
    $request->bindValue(":offerId",$offerId,PDO::PARAM_INT);
    $request->execute();
    $result = $database->lastInsertId();
    $request->closeCursor();
    return $result;
}

// Récupération des images d'une offre par son Id
function getImagesOfOffer($offerId) {
    $database = connexionPDO();
    $query = 'SELECT i.id_image, i.name_image, i.url_image FROM images i
        INNER JOIN offers_images io on i.id_image = io.id_image
        INNER JOIN offers o on o.id_offer = io.id_offer
        WHERE o.id_offer = :offerId
    ';
    $request = $database->prepare($query);
    $request->bindValue(":offerId",$offerId,PDO::PARAM_INT);
    $request->execute();
    $images = $request->fetchAll(PDO::FETCH_ASSOC);
    $request->closeCursor();
    return $images;
}

// Récupération de l'image d'une offre par son Id
function getImageOfOffer($offerId) {
    $database = connexionPDO();
    $query = 'SELECT i.id_image, i.name_image, i.url_image FROM images i
        INNER JOIN offers_images io on i.id_image = io.id_image
        INNER JOIN offers o on o.id_offer = io.id_offer
        WHERE o.id_offer = :offerId LIMIT 1
    ';
    $request = $database->prepare($query);
    $request->bindValue(":offerId",$offerId,PDO::PARAM_INT);
    $request->execute();
    $images = $request->fetchAll(PDO::FETCH_ASSOC);
    $request->closeCursor();
    return $images;
}


// Suppression des images d'une offre à partir de son Id
function deleteImagesOfOffer($imageId, $offerId) {
    $database = connexionPDO();
    $query = 'DELETE FROM offers_images 
        WHERE id_image =:imageId AND id_offer =:offerId';
    $request = $database->prepare($query);
    $request->bindValue(":imageId",$imageId,PDO::PARAM_INT);
    $request->bindValue(":offerId",$offerId,PDO::PARAM_INT);
    $result = $request->execute();
    $request->closeCursor();
    return $result;
}
