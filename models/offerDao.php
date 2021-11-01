<?php
// Importation des Fichiers
require_once "config/config.php";
require_once "pdo.php";


// Enregistrement de l'offre en Base De Données
function insertOfferToDatabase($category, $price, $availablity, $public, $contract, $description, $owner, $pieces,
                               $area, $country, $city, $address, $postalCode, $offerPeculiarity, $offerCreateDate): string
{
    $database = connexionPDO();
    $query = 'INSERT INTO offers (category_offer, price_offer, availablity_offer, public_offer, contract_offer, description_offer, offer_owner,
                    pieces_offer, area_offer, country_offer, city_offer, location_offer, postal_code_offer, offer_peculiarity, offer_create_date) 
                VALUES (:category_offer, :price_offer, :availablity_offer, :public_offer, :contract_offer, :description_offer, :offer_owner,
                        :pieces_offer, :area_offer, :country_offer, :city_offer, :location_offer, :postal_code_offer, :offer_peculiarity, :offer_create_date)';
    $request = $database->prepare($query);
    $request->bindValue(":category_offer", $category, PDO::PARAM_STR);
    $request->bindValue(":price_offer", $price, PDO::PARAM_STR);
    $request->bindValue(":availablity_offer", $availablity, PDO::PARAM_STR);
    $request->bindValue(":public_offer", $public, PDO::PARAM_STR);
    $request->bindValue(":contract_offer", $contract, PDO::PARAM_STR);
    $request->bindValue(":description_offer", $description, PDO::PARAM_STR);
    $request->bindValue(":pieces_offer", $pieces, PDO::PARAM_STR);
    $request->bindValue(":area_offer", $area, PDO::PARAM_STR);
    $request->bindValue(":country_offer", $country, PDO::PARAM_STR);
    $request->bindValue(":city_offer", $city, PDO::PARAM_STR);
    $request->bindValue(":location_offer", $address, PDO::PARAM_STR);
    $request->bindValue(":postal_code_offer", $postalCode, PDO::PARAM_STR);
    $request->bindValue(":offer_peculiarity", $offerPeculiarity, PDO::PARAM_STR);
    $request->bindValue(":offer_owner", $owner, PDO::PARAM_INT);
    $request->bindValue(":offer_create_date", $offerCreateDate, PDO::PARAM_STR);
    $request->execute();
    $result = $database->lastInsertId();
    $request->closeCursor();
    return $result;
}


// Récupération des Catégories d'offres
function getOfferCategories(): array
{
    $database = connexionPDO();
    $query = 'SELECT * FROM offers_categories';
    $request = $database->prepare($query);
    $request->execute();
    $categories = $request->fetchAll(PDO::FETCH_ASSOC);
    $request->closeCursor();
    return $categories;
}


// Récupération du Public visé par l'offre
function getOfferPublic(): array
{
    $database = connexionPDO();
    $query = 'SELECT * FROM offers_public';
    $request = $database->prepare($query);
    $request->execute();
    $categories = $request->fetchAll(PDO::FETCH_ASSOC);
    $request->closeCursor();
    return $categories;
}


// Récupération des Données (Offres) de la Base De Données
function getOffers(): array
{
    $database = connexionPDO();
    $query = 'SELECT * FROM offers';
    $request = $database->prepare($query);
    $request->execute();
    $offers = $request->fetchAll(PDO::FETCH_ASSOC);
    $request->closeCursor();
    return $offers;
}


// Récupération d'une Offre par son ID de la Base De Données
function getOfferById($offerId)
{
    $database = connexionPDO();
    $query = 'SELECT * FROM offers WHERE id_offer = :id_offer';
    $request = $database->prepare($query);
    $request->bindValue(":id_offer", $offerId, PDO::PARAM_INT);
    $request->execute();
    $offer = $request->fetch(PDO::FETCH_ASSOC);
    $request->closeCursor();
    return $offer;
}


// On récupére Toutes les offres postées par l'utilisateur à partir de son Id
function getOfferByOwner($offerOwnerId): array
{
    $database = connexionPDO();
    $query = 'SELECT * FROM offers WHERE offer_owner = :offer_owner';
    $request = $database->prepare($query);
    $request->bindValue(":offer_owner", $offerOwnerId, PDO::PARAM_INT);
    $request->execute();
    $offer = $request->fetchAll(PDO::FETCH_ASSOC);
    $request->closeCursor();
    return $offer;
}

// Récupérer une offre par son statut et l'Id de son auteur
function getOfferByStatusIdAndOfferOwnerId($offerStatusId, $offerOwnerId): array
{
    $database = connexionPDO();
    $query = 'SELECT * FROM offers o
        INNER JOIN offers_approval oa on o.id_offer = oa.id_offer
        INNER JOIN approval a on a.id_approval = oa.id_approval
        WHERE oa.id_approval = :offer_status_id AND offer_owner = :offer_owner
    ';
    $request = $database->prepare($query);
    $request->bindValue(":offer_status_id",$offerStatusId,PDO::PARAM_INT);
    $request->bindValue(":offer_owner", $offerOwnerId, PDO::PARAM_INT);
    $request->execute();
    $offers = $request->fetchAll(PDO::FETCH_ASSOC);
    $request->closeCursor();
    return $offers;
}

// ******************
function getUserOffersList($offerStatusId, $offerOwnerId, $offset, $numberOfLinesPerPage): array
{
    $database = connexionPDO();
    $query = 'SELECT * FROM offers o
        INNER JOIN offers_approval oa on o.id_offer = oa.id_offer
        INNER JOIN approval a on a.id_approval = oa.id_approval
        WHERE oa.id_approval = :offer_status_id AND offer_owner = :offer_owner
        LIMIT :offset, :limit;
    ';
    $request = $database->prepare($query);
    $request->bindValue(":offer_status_id",$offerStatusId,PDO::PARAM_INT);
    $request->bindValue(":offer_owner", $offerOwnerId, PDO::PARAM_INT);
    //$request->execute([$numberOfLinesPerPage, $offset]);
    //$request->execute(['limit' => $numberOfLinesPerPage, 'offsett' => $offset]);
    //$request->execute(['limit' => 2, 'offsett' => 2]);
    $request->bindParam(':offset',$offset, PDO::PARAM_INT);
    $request->bindParam(':limit', $numberOfLinesPerPage, PDO::PARAM_INT);
    //$request->bindValue(":number_of_lines_per_page", $numberOfLinesPerPage, PDO::PARAM_INT);
    //$request->bindValue(":offset_page", $offset, PDO::PARAM_INT);
    $request->execute();
    $offers = $request->fetchAll(PDO::FETCH_ASSOC);
    $request->closeCursor();
    return $offers;
}


// Édition des informations d'une offre à partir de son Id
function updateOfferById($offerId, $category, $price, $availablity, $public, $contract, $description, $pieces,
                         $area, $country, $city, $address, $postalCode, $offerPeculiarity, $offerUpdateDate): bool
{
    $database = connexionPDO();
    $query = 'UPDATE offers SET category_offer = :category_offer, price_offer = :price_offer, 
                  availablity_offer = :availablity_offer, public_offer = :public_offer,contract_offer = :contract_offer, 
                  description_offer = :description_offer, pieces_offer = :pieces_offer, area_offer = :area_offer,
                  country_offer = :country_offer, city_offer = :city_offer, location_offer = :location_offer, 
                  postal_code_offer = :postal_code_offer, offer_peculiarity = :offer_peculiarity, offer_update_date = :offer_update_date    
        WHERE id_offer = :id_offer';
    $request = $database->prepare($query);
    $request->bindValue(":id_offer", $offerId, PDO::PARAM_STR);
    $request->bindValue(":category_offer", $category, PDO::PARAM_STR);
    $request->bindValue(":price_offer", $price, PDO::PARAM_STR);
    $request->bindValue(":availablity_offer", $availablity, PDO::PARAM_STR);
    $request->bindValue(":public_offer", $public, PDO::PARAM_STR);
    $request->bindValue(":contract_offer", $contract, PDO::PARAM_STR);
    $request->bindValue(":description_offer", $description, PDO::PARAM_STR);
    $request->bindValue(":pieces_offer", $pieces, PDO::PARAM_STR);
    $request->bindValue(":area_offer", $area, PDO::PARAM_STR);
    $request->bindValue(":country_offer", $country, PDO::PARAM_STR);
    $request->bindValue(":city_offer", $city, PDO::PARAM_STR);
    $request->bindValue(":location_offer", $address, PDO::PARAM_STR);
    $request->bindValue(":postal_code_offer", $postalCode, PDO::PARAM_STR);
    $request->bindValue(":offer_peculiarity", $offerPeculiarity, PDO::PARAM_STR);
    $request->bindValue(":offer_update_date", $offerUpdateDate, PDO::PARAM_STR);
    $result = $request->execute();
    $request->closeCursor();
    if ($result > 0) return true;
    return false;
}

// Éditer le statut d'une offre
function updateOfferStatusById($offerId, $statusId): bool
{
    $database = connexionPDO();
    $query = 'UPDATE offers_approval SET id_approval = :id_approval    
        WHERE id_offer = :id_offer';
    $request = $database->prepare($query);
    $request->bindValue(":id_offer", $offerId, PDO::PARAM_INT);
    $request->bindValue(":id_approval", $statusId, PDO::PARAM_INT);
    $result = $request->execute();
    $request->closeCursor();
    if ($result > 0) return true;
    return false;
}

// Suppression d'une Offre
function deleteOfferById($offerId, $offerOwner): bool
{
    $database = connexionPDO();
    $query = 'DELETE FROM offers WHERE id_offer = :id_offer AND offer_owner = :offer_owner';
    $request = $database->prepare($query);
    $request->bindValue(":id_offer", $offerId, PDO::PARAM_INT);
    $request->bindValue(":offer_owner", $offerOwner, PDO::PARAM_INT);
    $result = $request->execute();
    $request->closeCursor();
    if ($result > 0) return true;
    return false;
}

// Suppression d'une offre par un admin
function deleteOfferWithAdminStatus($offerId): bool
{
    $database = connexionPDO();
    $query = 'DELETE FROM offers WHERE id_offer = :id_offer';
    $request = $database->prepare($query);
    $request->bindValue(":id_offer", $offerId, PDO::PARAM_INT);
    $result = $request->execute();
    $request->closeCursor();
    if ($result > 0) return true;
    return false;
}

// Assignation de statuts aux offres
function offerStatusAssignation($offerId, $statusId): string
{
    $database = connexionPDO();
    $query = 'INSERT INTO offers_approval (id_offer, id_approval) 
                VALUES (:id_offer, :id_status)';
    $request = $database->prepare($query);
    $request->bindValue(":id_offer", $offerId, PDO::PARAM_INT);
    $request->bindValue(":id_status", $statusId, PDO::PARAM_INT);
    $request->execute();
    $result = $database->lastInsertId();
    $request->closeCursor();
    return $result;
}

// Récupération du ou des statut(s) de l'utilisateur
function getOfferStatusById($offerId): array
{
    $database = connexionPDO();
    $query = 'SELECT * FROM approval s
        INNER JOIN offers_approval os on s.id_approval = os.id_approval
        INNER JOIN offers o on o.id_offer = os.id_offer
        WHERE o.id_offer = :id_offer
    ';
    $request = $database->prepare($query);
    $request->bindValue(":id_offer",$offerId,PDO::PARAM_INT);
    $request->execute();
    $usersRoles = $request->fetchAll(PDO::FETCH_ASSOC);
    $request->closeCursor();
    return $usersRoles;
}
