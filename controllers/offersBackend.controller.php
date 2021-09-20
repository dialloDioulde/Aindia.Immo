<?php
// Importation des Fichiers
require_once "config/config.php";
require_once "public/utils/formatage.php";
require_once "public/utils/imageManagement.php";
require_once "models/pdo.php";
require_once "models/offerDao.php";
require_once "models/userDao.php";
require_once "models/imageDao.php";


// Création d'une offre via AJAX
function createOfferWithAJAX() {
    if (isset($_POST['offerPrice']) && !empty($_POST['offerPrice']) &&
        isset($_POST['offerAvailable']) && !empty($_POST['offerAvailable']) &&
        isset($_POST['offerTime']) && !empty($_POST['offerTime']) &&
        isset($_POST['offerDescription']) && !empty($_POST['offerDescription']) &&
        isset($_POST['offerPieces']) && !empty($_POST['offerPieces']) &&
        isset($_POST['offerArea']) && !empty($_POST['offerArea']) &&
        isset($_POST['offerCountry']) && !empty($_POST['offerCountry']) &&
        isset($_POST['offerCity']) && !empty($_POST['offerCity']) &&
        isset($_POST['offerAddress']) && !empty($_POST['offerAddress']) &&
        isset($_POST['offerPostalCode']) && !empty($_POST['offerPostalCode'])
    ) {
        $offerCategory = Security::securityHtml($_POST['offerCategory']);
        $offerPrice = Security::securityHtml($_POST['offerPrice']);
        $offerAvailable = Security::securityHtml($_POST['offerAvailable']);
        $offerPeople = Security::securityHtml($_POST['offerPeople']);
        $offerTime = Security::securityHtml($_POST['offerTime']);
        $offerDescription = Security::securityHtml($_POST['offerDescription']);
        $offerPieces = Security::securityHtml($_POST['offerPieces']);
        $offerArea = Security::securityHtml($_POST['offerArea']);
        $offerCountry = Security::securityHtml($_POST['offerCountry']);
        $offerCity = Security::securityHtml($_POST['offerCity']);
        $offerAddress = Security::securityHtml($_POST['offerAddress']);
        $offerPostalCode = Security::securityHtml($_POST['offerPostalCode']);
        $numberOfImage = count($_FILES["offerImage"]['name']);

        if (isset($_SESSION["id"])) {
            $offerOwner = $_SESSION["id"];
            if ($numberOfImage >= 4 && $numberOfImage <= 10) {
                $offerId = insertOfferToDatabase($offerCategory, $offerPrice, $offerAvailable, $offerPeople, $offerTime, $offerDescription,
                    $offerOwner, $offerPieces, $offerArea, $offerCountry, $offerCity, $offerAddress, $offerPostalCode);
                if ($offerId > 0) {
                    addImage($_FILES["offerImage"], $offerCategory, $offerPrice, $offerId, ALERT_OFFER_CREATE);
                } else {
                    echo json_encode(ALERT_OFFER_CREATE_ERROR);
                }
            } else {
                echo json_encode(ALERT_OFFER_CREATE_NUMBER_OF_IMAGES);
            }
        } else {
            echo json_encode(ALERT_USER_NOT_LOGIN_ERROR);
        }
    }
}


// Récupération des données d'une offre à partir de son ID via AJAX
function getDataOfOfferWithAJAX() {
    if (isset($_POST['offerId']) && !empty($_POST['offerId'])) {
        $offerId = $_POST['offerId'];
        $offer = getOfferById($offerId);
        echo json_encode($offer);
    }
}


// Édition des informations d'une offre par son ID via AJAX
function editDataOfOfferWithAJAX() {
    if (isset($_POST['offerId']) && !empty($_POST['offerId']) &&
        isset($_POST['offerPrice']) && !empty($_POST['offerPrice']) &&
        isset($_POST['offerAvailable']) && !empty($_POST['offerAvailable']) &&
        isset($_POST['offerTime']) && !empty($_POST['offerTime']) &&
        isset($_POST['offerDescription']) && !empty($_POST['offerDescription']) &&
        isset($_POST['offerPieces']) && !empty($_POST['offerPieces']) &&
        isset($_POST['offerArea']) && !empty($_POST['offerArea']) &&
        isset($_POST['offerCountry']) && !empty($_POST['offerCountry']) &&
        isset($_POST['offerCity']) && !empty($_POST['offerCity']) &&
        isset($_POST['offerAddress']) && !empty($_POST['offerAddress']) &&
        isset($_POST['offerPostalCode']) && !empty($_POST['offerPostalCode'])
    ) {
        $offerCategory = Security::securityHtml($_POST['offerCategory']);
        $offerPrice = Security::securityHtml($_POST['offerPrice']);
        $offerAvailable = Security::securityHtml($_POST['offerAvailable']);
        $offerPeople = Security::securityHtml($_POST['offerPeople']);
        $offerTime = Security::securityHtml($_POST['offerTime']);
        $offerDescription = Security::securityHtml($_POST['offerDescription']);
        $offerPieces = Security::securityHtml($_POST['offerPieces']);
        $offerArea = Security::securityHtml($_POST['offerArea']);
        $offerCountry = Security::securityHtml($_POST['offerCountry']);
        $offerCity = Security::securityHtml($_POST['offerCity']);
        $offerAddress = Security::securityHtml($_POST['offerAddress']);
        $offerPostalCode = Security::securityHtml($_POST['offerPostalCode']);
        $imagesToDelete = Security::securityHtml($_POST['imagesToDelete']);
        $offerId = Security::securityHtml($_POST['offerId']);

        if (isset($_SESSION["id"])) {
            // Enregistrement des modifications apportées à l'offre
            $result = updateOfferById($offerId, $offerCategory, $offerPrice, $offerAvailable, $offerPeople, $offerTime,
                $offerDescription, $offerPieces, $offerArea, $offerCountry, $offerCity, $offerAddress, $offerPostalCode);
            // Suppression de toutes les images contenues dans $ImagesId
            if (isset($imagesToDelete) && !empty($imagesToDelete)) {
                $ImagesId = explode(",", $imagesToDelete);
                for ($i = 0; $i < count($ImagesId); $i++) {
                    deleteImagesOfOffer($ImagesId[$i], $offerId);
                }
            }
            // Enregistrement des nouvelles images associées à l'offre
            if ($result) {
                $imageSize = $_FILES["offerImage"]['size'][0];
                if ($imageSize > 0 ) {
                    addImage($_FILES["offerImage"], $offerCategory, $offerPrice, $offerId, ALERT_OFFER_UPDATE);
                } else {
                    echo json_encode(ALERT_OFFER_UPDATE);
                }
            } else {
                echo json_encode(ALERT_OFFER_UPDATE_ERROR);
            }
        } else {
            echo json_encode(ALERT_USER_NOT_LOGIN_ERROR);
        }
    }
}
