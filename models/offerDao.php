<?php
// Importation des Fichiers
require_once "config/config.php";
require_once "pdo.php";


// Enregistrement de l'offre en Base De Données
function insertOfferToDatabase($category, $price, $availablity, $public, $contract, $description, $owner, $pieces, $area, $country, $city, $address, $postalCode)
{
    $database = connexionPDO();
    $query = 'INSERT INTO offers (category_offer, price_offer, availablity_offer, public_offer, contract_offer, description_offer, offer_owner,
                    pieces_offer, area_offer, country_offer, city_offer, location_offer, postal_code_offer) 
                VALUES (:category_offer, :price_offer, :availablity_offer, :public_offer, :contract_offer, :description_offer, :offer_owner,
                        :pieces_offer, :area_offer, :country_offer, :city_offer, :location_offer, :postal_code_offer)';
    $request = $database->prepare($query);
    $request->bindValue(":category_offer", $category, PDO::PARAM_INT);
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
    $request->bindValue(":offer_owner", $owner, PDO::PARAM_INT);
    $request->execute();
    $result = $database->lastInsertId();
    $request->closeCursor();
    return $result;
}


// Récupération des Catégories d'offres
function getOfferCategories()
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
function getOfferPublic()
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
function getOffers()
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


// On récupére les Informations du Propriétaire de l'Offre postée
function getOfferOwner($offerOwnerId)
{
    $database = connexionPDO();
    $query = '
                SELECT u.name_user, u.email_user, u.address_user, c.name_category, o.job_offer
                FROM users u 
                INNER JOIN offers o on u.id_user = o.id_owner_offer
                INNER JOIN categories c on c.id_category = o.id_category_offer
                WHERE o.id_owner_offer = :id_owner_offer
                ORDER BY o.publication_date_offer
            ';
    $request = $database->prepare($query);
    $request->bindValue(":id_owner_offer", $offerOwnerId, PDO::PARAM_INT);
    $request->execute();
    $owner_category = $request->fetch(PDO::FETCH_ASSOC);
    $request->closeCursor();
    return $owner_category;
}


// Édition des informations d'une offre à partir de son Id
function updateOfferById($offerId, $category, $price, $availablity, $public, $contract, $description, $pieces, $area, $country, $city, $address, $postalCode) {
    $database = connexionPDO();
    $query = 'UPDATE offers SET category_offer = :category_offer, price_offer = :price_offer, 
                  availablity_offer = :availablity_offer, public_offer = :public_offer,contract_offer = :contract_offer, 
                  description_offer = :description_offer, pieces_offer = :pieces_offer, area_offer = :area_offer,
                  country_offer = :country_offer, city_offer = :city_offer, location_offer = :location_offer, 
                  postal_code_offer = :postal_code_offer    
        WHERE id_offer = :id_offer';
    $request = $database->prepare($query);
    $request->bindValue(":id_offer", $offerId, PDO::PARAM_STR);
    $request->bindValue(":category_offer", $category, PDO::PARAM_INT);
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
    $result = $request->execute();
    $request->closeCursor();
    if ($result > 0) return true;
    return false;
}


// Suppression d'une Offre
function deleteOfferById($offerId, $offerOwner)
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
