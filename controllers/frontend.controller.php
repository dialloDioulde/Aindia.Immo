<?php
// Importation des Fichiers
require_once "config/config.php";
require_once "public/utils/formatage.php";
require_once "models/pdo.php";
require_once "models/offerDao.php";
require_once "models/imageDao.php";
require_once "models/publicDao.php";
require_once "models/categoryDao.php";
require_once "models/userDao.php";
require_once "models/statusDao..php";
require_once "public/utils/getPagination.php";

// Fonction qui renvoie la view ACCUEIL
function getOffersViews() {
    $title = "Accueil";
    $description = "Page d'accueil et présentation des offres";
    $offers = getOffers();
    require_once "views/frontend/offers/offers.view.php";
}

// Fonction qui renvoie la view OFFER DETAILS
function getOfferDetailsView() {

    if(isset($_GET['id_offer']) && !empty($_GET['id_offer'])) {

        $id_offer = Security::securityHtml($_GET['id_offer']);
        $offer = getOfferById($id_offer);
        $images = getImagesOfOffer($offer['id_offer']);
        $publicOffer = getPublicOfOffer($offer['public_offer']);
        $categoryOffer = getCategoryOfOffer($offer['category_offer']);
        $offer_owner = getUserById($offer['offer_owner']);

        $title = "L'Offre N° " . $offer['id_offer'];
        $description = "Page contenant les détails de l'offre";

        require_once "views/frontend/offers/offerDetails.view.php";

    } else {
        throw new Exception("L'Accès à cette page n'est pas Autorisé !");

    }
}


// Fonction qui renvoie la view A.INTERIM
function getAindiaInterimView() {
    $title = "A.Intérim";
    $description = "Page présentant Aindia Intérim";
    require_once "views/frontend/a.interim/a.interim.view.php";
}


// Fonction qui renvoie la view Contact
function getContactView() {
    $title = "Contacts";
    $description = "Page de nos Contacts";
    require_once "views/frontend/contacts/contact.view.php";
}


// Fonction qui renvoie la page de profile de l'utilisateur
function getUserProfilView() {
    $title = "Profile";
    $description = "Page de profil de l'utilisateur";

    $contentView = "";
    if (isset($_GET["actionType"]) && $_GET["actionType"] === "approved") {
        $title = "Offres Approuvées";
        $description = "Page contenant les offres approuvées";
        $OFFER_HEADER_TITLE = "Offres Approuvées";
        $getPagination = getPagination(1, $_SERVER['REQUEST_URI']);
        $offers = $getPagination[0];
        $totalNumberOfPages = $getPagination[1];
        $hasPagination = $getPagination[2];
        require_once "views/frontend/offers/offerApproved.view.php";
    } elseif (isset($_GET["actionType"]) && $_GET["actionType"] === "pending") {
        $title = "Offres en Attentes";
        $description = "Page contenant les offres en attantes d'approbation";
        $OFFER_HEADER_TITLE = "Offres en Attentes d'approbation";
        $getPagination = getPagination(6, $_SERVER['REQUEST_URI']);
        $offers = $getPagination[0];
        $totalNumberOfPages = $getPagination[1];
        $hasPagination = $getPagination[2];
        //require_once "views/frontend/offers/offerPending.view.php";
        require_once "views/frontend/offers/offerApproved.view.php";
    } elseif (isset($_GET["actionType"]) && $_GET["actionType"] === "moderated") {
        $title = "Offres Modérées";
        $description = "Page contenant les offres modérées par nos services";
        $OFFER_HEADER_TITLE = "Offres Modérées";
        $getPagination = getPagination(3, $_SERVER['REQUEST_URI']);
        $offers = $getPagination[0];
        $totalNumberOfPages = $getPagination[1];
        $hasPagination = $getPagination[2];
        //require_once "views/frontend/offers/offerModerated.view.php";
        require_once "views/frontend/offers/offerApproved.view.php";
    } elseif (isset($_GET["actionType"]) && $_GET["actionType"] === "hided") {
        $title = "Offres Retirées";
        $description = "Page contenant les offres retirées de notre système";
        $OFFER_HEADER_TITLE = "Offres Retirées";
        $getPagination = getPagination(4, $_SERVER['REQUEST_URI']);
        $offers = $getPagination[0];
        $totalNumberOfPages = $getPagination[1];
        $hasPagination = $getPagination[2];
        //require_once "views/frontend/offers/offerHided.view.php";
        require_once "views/frontend/offers/offerApproved.view.php";
    } elseif (isset($_GET["actionType"]) && $_GET["actionType"] === "blocked") {
        $title = "Offres Bloquées";
        $description = "Page contenant les offres retirées de notre système";
        $OFFER_HEADER_TITLE = "Offres Bloquées";
        $getPagination = getPagination(5, $_SERVER['REQUEST_URI']);
        $offers = $getPagination[0];
        $totalNumberOfPages = $getPagination[1];
        $hasPagination = $getPagination[2];
        require_once "views/frontend/offers/offerApproved.view.php";
        //require_once "views/frontend/offers/offerBlocked.view.php";
    }
    require_once "views/frontend/account/userProfil.view.php";
}

