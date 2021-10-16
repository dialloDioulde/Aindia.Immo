<?php
// Importation des Fichiers
require_once "config/config.php";
require_once "public/utils/formatage.php";
require_once "public/utils/imageManagement.php";
require_once "public/utils/token.php";
require_once "public/utils/userRolesManagement.php";
require_once "models/pdo.php";
require_once "models/offerDao.php";
require_once "models/userDao.php";
require_once "models/imageDao.php";
require_once "models/publicDao.php";
require_once "models/categoryDao.php";
require_once "models/statusDao..php";

// Création du compte du compte utilisateur
function userRegister()
{
    $title = "Inscription";
    $description = "Page de d'Inscription";
    $ALERT_USER_REGISTER_EMAIL_VALIDATION_MESSAGE = "";
    $ALERT_USER_REGISTER_USERNAME_EXIST_ERROR = "";
    $ALERT_USER_REGISTER_EMAIL_EXIST_ERROR = "";
    $ALERT_USER_REGISTER_EMAIL_VALIDATION_MESSAGE = "";
    $ALERT_USER_REGISTER_EMAIL_VALIDATION_MESSAGE_SENT = "";

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
            $ALERT_USER_REGISTER_USERNAME_EXIST_ERROR = ALERT_USER_REGISTER_USERNAME_EXIST_ERROR;
        } elseif ($emailResult > 0) {
            $ALERT_USER_REGISTER_EMAIL_EXIST_ERROR = ALERT_USER_REGISTER_EMAIL_EXIST_ERROR;
        } else {
            $userId = registerUserOnDatabase($username, $email, $password, $token);
            userRoleAssignation($userId, 1);
            $to = $email;
            $subject = "Validation | Inscription ";
            $message = 'Bonjour '.mb_strtoupper($username).', votre compte a bien été créé ! '. "\r\n" . "\r\n" .
                'Afin de valider votre inscription veuillez cliquer sur le lien ci-dessous : '. "\r\n" . "\r\n" .
                'https://www.house.diouldediallo.fr/aindiaImmo/userEmailValidation&email='.$email.'&token='.$token.''. "\r\n" .
                'Merci pour votre inscription !' . "\r\n" . "\r\n" . "";
            $headers = 'From:noreply@aindia.net' . "\r\n";
            mail($to, $subject, $message, $headers);
            $ALERT_USER_REGISTER_EMAIL_VALIDATION_MESSAGE_SENT = ALERT_USER_REGISTER_EMAIL_VALIDATION_MESSAGE_SENT;
        }
    }
}

// Connexion de l'utilisateur
function userLogin()
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
            $userRoles = getUserRolesById($_SESSION['id']);
            $_SESSION['role_is_user'] = roleIsUser($userRoles);
            $_SESSION['role_is_admin'] = roleIsAdmin($userRoles);
            Security::generateCookiePassword();
            header("Location: welcomeOffer");
        } else {
            $ALERT_USER_LOGIN_ERROR = ALERT_USER_LOGIN_ERROR;
        }
    }
}

// Validation de l'adresse mail de l'utilisateur
function getUserEmailValidationView()
{
    $ALERT_USER_REGISTER_EMAIL_VALIDATION_MESSAGE = "";
    $ALERT_USER_REGISTER_EMAIL_VALIDATION_ERROR = "";
    $ALERT_USER_REGISTER_EMAIL_VALIDATION_LINK_ERROR = "";
    $title = "Validation Compte Utilisateur";
    $description = "Validation du compte utilisateur";

    $email = $_GET['email'];
    $token = $_GET['token'];
    $user = getUserByEmailAndToken($email, $token);
    if ($user > 0) {
        $result = userRegisterValidation($email);
        if ($result) {
            $ALERT_USER_REGISTER_EMAIL_VALIDATION_MESSAGE = ALERT_USER_REGISTER_EMAIL_VALIDATION_MESSAGE;
        } else {
            $ALERT_USER_REGISTER_EMAIL_VALIDATION_ERROR = ALERT_USER_REGISTER_EMAIL_VALIDATION_ERROR;
        }
    } else {
        $ALERT_USER_REGISTER_EMAIL_VALIDATION_LINK_ERROR = ALERT_USER_REGISTER_EMAIL_VALIDATION_LINK_ERROR;
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

// Users managing View
function getManageUsersView() {
    $title = "Gestion des Utilisateurs";
    $description = "Page de Gestion des utilisateurs";
    require_once "views/backend/dashboard/manageUsers.php";
}

// Offers managing View
function getManageOffersView() {
    $title = "Gestion des Offres";
    $description = "Page de Gestion des offres";
    require_once "views/backend/dashboard/manageOffers.php";
}

// Register Or Login View
function getRegisterOrViewView() {
    $title = "Inscription ou Connexion";
    $description = "Page d'Inscription ou de Connexion";
    $contentView = "";
    if (isset($_GET["actionType"]) && $_GET["actionType"] === "registerView") {
        userRegister();
        require_once "views/backend/account/userRegister.view.php";
    } elseif (isset($_GET["actionType"]) && $_GET["actionType"] === "loginView") {
        userLogin();
        require_once "views/backend/account/userLogin.view.php";
    }
    require_once "views/backend/account/registerOrLogin.view.php";
}
