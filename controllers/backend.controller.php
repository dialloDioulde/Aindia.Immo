<?php
// Importation des Fichiers
require_once "config/config.php";
require_once "public/utils/formatage.php";
require_once "public/utils/imageManagement.php";
require_once "public/utils/token.php";
require_once "models/pdo.php";
require_once "models/offerDao.php";
require_once "models/userDao.php";
require_once "models/imageDao.php";
require_once "models/publicDao.php";
require_once "models/categoryDao.php";


// Création du compte du compte utilisateur
function getUserRegisterView()
{
    $title = "Inscription";
    $description = "Page de d'Inscription";
    $ALERT_USER_REGISTER_USERNAME_ERROR = "";
    $ALERT_USER_REGISTER_EMAIL_ERROR = "";
    $ALERT_USER_REGISTER_EMAIL_VALIDATION_MESSAGE = "";
    $ALERT_USER_REGISTER_EMAIL_VALIDATION_ERROR_MESSAGE = "";

    if (isset($_POST['username']) && !empty($_POST['username']) &&
        isset($_POST['email']) && !empty($_POST['email']) &&
        isset($_POST['password']) && !empty($_POST['password']) &&
        isset($_POST['passwordConfirmation']) && !empty($_POST['passwordConfirmation'])
    ) {
        $username = Security::securityHtml($_POST['username']);
        $email = Security::securityHtml($_POST['email']);
        $password = Security::securityHtml($_POST['password']);
        $token = generateToken();

        $usernameResult = getUserByUsername($username);
        $emailResult = getUserByEmail($email);
        if ($usernameResult > 0) {
            $ALERT_USER_REGISTER_USERNAME_ERROR = ALERT_USER_REGISTER_USERNAME_ERROR;
        } elseif ($emailResult > 0) {
            $ALERT_USER_REGISTER_EMAIL_ERROR = ALERT_USER_REGISTER_EMAIL_ERROR;
        } else {
            registerUserOnDatabase($username, $email, $password, $token);
            $to = $email;
            $subject = "Validation | Inscription ";
            $message = 'Bonjour '.mb_strtoupper($username).', votre compte a bien été créé ! '. "\r\n" . "\r\n" .
                'Afin de valider votre inscription veuillez cliquer sur le lien ci-dessous : '. "\r\n" . "\r\n" .
                'https://www.house.diouldediallo.fr/aindiaInterim/userEmailValidation?email='.$email.'&token='.$token.''. "\r\n" .
                'Merci pour votre inscription !' . "\r\n" . "\r\n" . "";

            $headers = 'From:noreply@aindia.net' . "\r\n";
            mail($to, $subject, $message, $headers);
        }
    }
    require_once "views/backend/account/userRegister.view.php";
}


// Connexion de l'utilisateur
function getUserLoginView()
{
    $ALERT_USER_LOGIN_ERROR = "";
    $title = "Connexion";
    $description = "Page de Connexion";
    if (isset($_POST['username']) && !empty($_POST['username']) &&
        isset($_POST['password']) && !empty($_POST['password'])) {
        $username = Security::securityHtml($_POST['username']);
        $password = Security::securityHtml($_POST['password']);
        if (loginUser($username, $password)) {
            $user = getUserByUsername($username);
            $_SESSION['id'] = $user['id_user'];
            $_SESSION['name_user'] = $user['name_user'];
            $_SESSION['email_user'] = $user['email_user'];
            Security::generateCookiePassword();
            header("Location: welcomeOffer");
        } else {
            $ALERT_USER_LOGIN_ERROR = ALERT_USER_LOGIN_ERROR;
        }
    }
    require_once "views/backend/account/userLogin.view.php";
}


// Validation de l'adresse mail de l'utilisateur
function getUserEmailValidationView()
{
    $ALERT = "";
    $TEST = "";
    $title = "Validation Compte Utilisateur";
    $description = "Validation du compte utilisateur";

    $email = $_GET['email'];
    $token = $_GET['token'];
    echo  $email ."<br/>";
    $user = getUserByEmailAndToken($email, $token);
    if ($user > 0) {
        $result = userRegisterValidation($email);
        if ($result) {
            echo "Votre compte a bien été validé !";
        } else {
            echo "Une erreur est survenue lors de la validation de votre compte !";
        }
    } else {
        echo "Aucun utilisateur ne correspond aux identifiants renseignés !";
    }

    require_once "views/backend/account/userEmailValidation.view.php";
}


// Fonction permettant de la deconnexion
function getUserLogoutView()
{
    $title = "Deconnexion";
    $description = "Page de deconnexion de l'utilisateur";
    if (isset($_SESSION["id"])) {
        session_unset();
        session_destroy();
        header("Location: welcomeOffer");
    }
    require_once "views/backend/account/userLogout.view.php";
}

// Enregistrement de l'offre
function getOfferCreateView()
{
    $title = "Création d'Ofrre";
    $description = "Page de publication d'ofrre";
    $ALERT_OFFER_CREATE = "";
    $ALERT_OFFER_CREATE_ERROR = "";

    if (isset($_POST['offerTitle']) && !empty($_POST['offerTitle']) &&
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
        $offerTitle = Security::securityHtml($_POST['offerTitle']);
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
        $offerId = "";

        if (isset($_SESSION["id"])) {
            $offerOwner = $_SESSION["id"];
            $offerId = insertOfferToDatabase($offerCategory, $offerPrice, $offerAvailable, $offerPeople, $offerTime, $offerDescription, $offerOwner, $offerPieces, $offerArea, $offerCountry, $offerCity, $offerAddress, $offerPostalCode);
        }

        if ($numberOfImage > 0) {
            addImage($_FILES["offerImage"], $offerCategory, $offerTitle, $offerId);
        }

    }
    require_once "views/backend/offers/offerCreate.view.php";
}



// Dashboard
function getDashboardView() {
    $title = "Administration du Site";
    $description = "Page de Gestion du Site";

    $contentDashboard = "";

    if (isset($_GET["actionType"]) && $_GET["actionType"] === "ManageUsers") {
        require_once "views/backend/dashboard/manageUsers.php";
    } elseif (isset($_GET["actionType"]) && $_GET["actionType"] === "ManageOffers") {
        require_once "views/backend/dashboard/manageOffers.php";
    }

    require_once "views/backend/dashboard/dashboard.php";
}


function getManageUsersView() {
    $title = "Gestion des Utilisateurs";
    $description = "Page de Gestion des utilisateurs";

    require_once "views/backend/dashboard/manageUsers.php";
}

function getManageOffersView() {
    $title = "Gestion des Offres";
    $description = "Page de Gestion des offres";

    require_once "views/backend/dashboard/manageOffers.php";
}
