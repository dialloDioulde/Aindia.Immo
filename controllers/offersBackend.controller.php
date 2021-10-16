<?php
// Importation des Fichiers
require_once "config/config.php";
require_once "public/utils/formatage.php";
require_once "public/utils/imageManagement.php";
require_once "public/utils/checkBoxValue.php";
require_once "models/pdo.php";
require_once "models/offerDao.php";
require_once "models/userDao.php";
require_once "models/imageDao.php";
require_once "models/statusDao..php";


// Création d'une offre via AJAX
function createOfferWithAJAX() {
    $response = array(
        'status' => 0,
        'message' => '',
        'hasError' => true,
        'data' => '',
    );
    $hasError = true;

    if (isset($_POST['offerPrice']) && !empty($_POST['offerPrice']) &&
        isset($_POST['offerAvailable']) && !empty($_POST['offerAvailable']) &&
        isset($_POST['offerTime']) && !empty($_POST['offerTime']) &&
        isset($_POST['offerDescription']) && !empty($_POST['offerDescription']) &&
        isset($_POST['offerPieces']) && !empty($_POST['offerPieces']) &&
        isset($_POST['offerArea']) && !empty($_POST['offerArea']) &&
        isset($_POST['offerCountry']) && !empty($_POST['offerCountry']) &&
        isset($_POST['offerCity']) && !empty($_POST['offerCity']) &&
        isset($_POST['offerAddress']) && !empty($_POST['offerAddress']) &&
        isset($_POST['offerPostalCode']) && !empty($_POST['offerPostalCode']) &&
        isset($_POST['checkBoxValue']) && !empty($_POST['checkBoxValue'])
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
        $offerPeculiarity = getCheckBoxValue($_POST['checkBoxValue']);

        if (isset($_SESSION["id"]) && !empty($_SESSION["id"])){
            $offerOwner = $_SESSION["id"];
            if ($numberOfImage >= 4 && $numberOfImage <= 10) {
                $offerId = insertOfferToDatabase($offerCategory, $offerPrice, $offerAvailable, $offerPeople, $offerTime,
                    $offerDescription, $offerOwner, $offerPieces, $offerArea, $offerCountry, $offerCity, $offerAddress,
                    $offerPostalCode, $offerPeculiarity);
                if ($offerId > 0) {
                    $hasError = false;
                    offerStatusAssignation($offerId, 6);
                    addImage($_FILES["offerImage"], $offerCategory, $offerPrice, $offerId, ALERT_OFFER_CREATE);
                } else {
                    $response['message'] = ALERT_OFFER_CREATE_ERROR;
                }
            }
            if (!($numberOfImage >= 4 && $numberOfImage <= 10))
                $response['message'] = ALERT_OFFER_CREATE_NUMBER_OF_IMAGES;
        }
        if (empty($_SESSION["id"]))
            $response['message'] = ALERT_USER_NOT_LOGIN_ERROR;
        if ($hasError)
            echo json_encode($response);
    }
}


// Récupération des données d'une offre à partir de son ID via AJAX
function getDataOfOfferWithAJAX() {
    if (isset($_POST['offerId']) && !empty($_POST['offerId'])) {
        $offerId = Security::securityHtml($_POST['offerId']);
        $offer = getOfferById($offerId);
        echo json_encode($offer);
    }
}

// Récupération de toutes les informations d'une offre à partir de son ID
function getAllDataOfOfferWithAJAX() {
    $data = array(
        'offerOwner' => '',
        'offerImages' => '',
        'offerData' => '',
        'offerPublic' => '',
        'offerCategory' => '',
    );
    if (isset($_POST['offerId']) && !empty($_POST['offerId'])) {
        $offerId = Security::securityHtml($_POST['offerId']);
        $offer = getOfferById($offerId);
        $data['offerOwner'] = getUserById($offer['offer_owner']);
        $data['offerImages'] = getImagesOfOffer($offerId);
        $data['offerData'] = $offer;
        $data['offerPublic'] = getPublicOfOffer($offer['public_offer']);
        $data['offerCategory'] = getCategoryOfOffer($offer['category_offer']);
        echo json_encode($data);
    }
}

// Édition des informations d'une offre par son ID via AJAX
function updateDataOfOfferWithAJAX() {
    $response = array(
        'status' => 0,
        'message' => '',
        'hasError' => true,
        'data' => '',
    );
    $hasError = true;

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
        isset($_POST['offerPostalCode']) && !empty($_POST['offerPostalCode']) &&
        isset($_POST['checkBoxValue']) && !empty($_POST['checkBoxValue'])
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
        $offerPeculiarity = getCheckBoxValue($_POST['checkBoxValue']);

        if (isset($_SESSION["id"]) && !empty($_SESSION["id"])) {
            // Enregistrement des modifications apportées à l'offre
            $result = updateOfferById($offerId, $offerCategory, $offerPrice, $offerAvailable, $offerPeople, $offerTime,
                $offerDescription, $offerPieces, $offerArea, $offerCountry, $offerCity, $offerAddress, $offerPostalCode,
                $offerPeculiarity);
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
                    $hasError = false;
                    addImage($_FILES["offerImage"], $offerCategory, $offerPrice, $offerId, ALERT_OFFER_UPDATE);
                } else {
                    $response['status'] = 1;
                    $response['data'] = getOfferById($offerId);
                    $response['message'] = ALERT_OFFER_UPDATE;
                }
            }
            if (!$result)
                $response['message'] = ALERT_OFFER_UPDATE_ERROR;
        }
        if (empty($_SESSION["id"]))
            $response['message'] = ALERT_USER_NOT_LOGIN_ERROR;
        if ($hasError)
            echo json_encode($response);
    }
}

// Récupération des données d'une offre à partir de son ID via AJAX
function getStatusOfOfferWithAJAX() {
    if (isset($_POST['offerId']) && !empty($_POST['offerId'])) {
        $offerId = Security::securityHtml($_POST['offerId']);
        $offerStatus = getStatusOfOfferById($offerId);
        echo json_encode($offerStatus);
    }
}

// Édition du statut d'une offre par son ID via AJAX
function editOfferStatusWithAJAX() {
    $response = array(
        'status' => 0,
        'message' => '',
    );
    if (isset($_POST['offerId']) && !empty($_POST['offerId']) &&
        isset($_POST['e_offerStatus']) && !empty($_POST['e_offerStatus'])) {
        $offerId = Security::securityHtml($_POST['offerId']);
        $offerStatusId = Security::securityHtml($_POST['e_offerStatus']);
        $result = updateOfferStatusById($offerId, $offerStatusId);
        if ($result > 0) {
            $response['status'] = 1;
            $response['message'] = ALERT_OFFER_STATUS_UPDATE;
        } else {
            $response['message'] = ALERT_OFFER_STATUS_UPDATE_ERROR;
        }
        echo json_encode($response);
    }
}


// Récupération des images d'une offre par son Id via AJAX
function getImagesOfOfferByIdWithAJAX() {
    $data = array(
        'offerId' => '',
        'imageData' => '',
    );
    if (isset($_POST['offerId']) && !empty($_POST['offerId'])) {
        $offerId = Security::securityHtml($_POST['offerId']);
        $data['offerId'] = $offerId;
        $data['imageData'] = getImagesOfOffer($offerId);
        echo json_encode($data);
    }
}


// Suppression d'une offre par son Id via AJAX
function deleteOfferByIdWithAJAX() {
    $data = array(
        'status' => 0,
        'offerId' => '',
        'message' => '',
    );
    if (isset($_POST['offerId']) && !empty($_POST['offerId'])) {
        if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
            $offerOwner = (int)$_SESSION['id'];
            $offerId = Security::securityHtml($_POST['offerId']);
            $result = deleteOfferById($offerId, $offerOwner);
            if ($result) {
                $data['status'] = 1;
                $data['offerId'] = $offerId;
                $data['message'] = "Votre offre a bien été supprimée";
            }
            $data['message'] = "Une erreur est survenue lors la suppression de l'offre";
        }
        $data['message'] = "Vous n'êtes pas connecté(e) !";
    }
    echo json_encode($data);
}

// Suppression d'une offre par son Id avec le statut Admin via AJAX
function deleteOfferByIdAndAdminStatusWithAJAX() {
    $data = array(
        'status' => 0,
        'offerId' => '',
        'message' => "",
    );
    if (isset($_POST['offerId']) && !empty($_POST['offerId'])) {
        if (isset($_SESSION['id']) && !empty($_SESSION['id']) && $_SESSION['role_is_admin']) {
            $offerId = Security::securityHtml($_POST['offerId']);
            $result = deleteOfferWithAdminStatus($offerId);
            if ($result) {
                $data['status'] = 1;
                $data['offerId'] = $offerId;
                $data['message'] = "Offre supprimée";
            }
            $data['message'] = "Une erreur est survenue lors la suppression de l'offre";
        }
        $data['message'] = "Vous n'avez pas les droits requis !";
    }
    echo json_encode($data);
}

