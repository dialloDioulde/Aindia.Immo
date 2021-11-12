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
require_once "public/utils/viewDataCustomization.php";

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

        $id_offer = $_GET['id_offer'];
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

/**
 * Fonction qui renvoie la page de profile de l'utilisateur
 */
function getUserProfilView() {
    $title = "Profile";
    $description = "Page de profil de l'utilisateur";
    $contentView = "";
    if (isset($_GET["actionType"]) && !empty($_GET["actionType"]) ) {
        $actionType = $_GET["actionType"];
        $viewDataCustomization = viewDataCustomization($actionType, $_SERVER['REQUEST_URI']);
        $viewHeaderTitle = $title = $viewDataCustomization[0];
        $description = $viewDataCustomization[1];
        $offers = $viewDataCustomization[2];
        $totalNumberOfPages = $viewDataCustomization[3];
        $hasPagination = $viewDataCustomization[4];
        require_once "./public/utils/offersTemplates/offerViewTemplate.php";
    } else {
        require_once "views/frontend/account/userDataView.view.php";
    }
    require_once "views/frontend/account/userProfil.view.php";
}

