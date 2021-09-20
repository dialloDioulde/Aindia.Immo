<?php
session_start();
// On gère le Routage du site WEB dans ce fichier
require_once "controllers/frontend.controller.php";
require_once "controllers/backend.controller.php";
require_once "controllers/offersBackend.controller.php";
require_once "config/Security.class.php";

try {
    if (isset($_GET['page']) && !empty($_GET['page'])) {
        $page = Security::securityHtml($_GET['page']); // On sécurise les données récupérées
        switch ($page) {
            case "welcomeOffer": getOffersViews();
            break;
            case "offerDetails": getOfferDetailsView();
            break;
            case "a.interim": getAindiaInterimView();
            break;
            case "contact": getContactView();
            break;
            case "userRegister": getUserRegisterView();
            break;
            case "userLogin": getUserLoginView();
            break;
            case "userEmailValidation": getUserEmailValidationView();
            break;
            case "userProfil": getUserProfilView();
            break;
            case "userLogout": getUserLogoutView();
            break;
            case "offerCreateView": getOfferCreateView();
            break;
            case "dashboard": getDashboardView();
            break;
            case "dashboardManageUsers": getManageUsersView();
            break;
            case "dashboardManageOffers": getManageOffersView();
            break;
            case "createOfferWithAJAX": createOfferWithAJAX();
            break;
            case "getDataOfOfferWithAJAX": getDataOfOfferWithAJAX();
            break;
            case "editDataOfOfferWithAJAX": editDataOfOfferWithAJAX();
            break;
            case "error301":
            case "error302":
            case "error400":
            case "error401":
            case "error402":
            case "error405":
            case "error500":
            case "error505": throw new Exception("Error de type : " . $page["page"]);
            break;
            case "error403": throw new Exception("L'Accès à ce Dossier n'est pas Autorisé");
            break;
            case "error404":
            default: throw new Exception("La Page n'existe pas !");
        }
    } else {
        getOffersViews();
    }
} catch (Exception $exception) {
    $title = "Erreur";
    $description = "Page des erreurs";
    $errorMessage = $exception->getMessage();
    require "views/commons/error.view.php";
}



