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
function userRegisterView()
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
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $token = generateToken();
        $createDate = date("Y-m-d H:i:s");

        $usernameResult = getUserByUsername($username);
        $emailResult = getUserByEmail($email);
        if ($usernameResult > 0) {
            $ALERT_USER_REGISTER_USERNAME_EXIST_ERROR = ALERT_USER_REGISTER_USERNAME_EXIST_ERROR;
        } elseif ($emailResult > 0) {
            $ALERT_USER_REGISTER_EMAIL_EXIST_ERROR = ALERT_USER_REGISTER_EMAIL_EXIST_ERROR;
        } else {
            $userId = registerUserOnDatabase($username, $email, $password, $token, $createDate);
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
    require_once "views/backend/account/userRegister.view.php";
}

// Connexion de l'utilisateur
function getUserLogin()
{
    $ALERT_USER_LOGIN_ERROR = "";
    $title = "Connexion";
    $description = "Page de Connexion";
    if (isset($_POST['username']) && !empty($_POST['username']) &&
        isset($_POST['password']) && !empty($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
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
    require_once "views/backend/account/userLogin.view.php";
}

// Validation de l'adresse mail de l'utilisateur
function getUserEmailValidationView()
{
    $title = "Validation Compte Utilisateur";
    $description = "Validation du compte utilisateur";
    $ALERT_USER_REGISTER_EMAIL_VALIDATION_MESSAGE = "";
    $ALERT_USER_REGISTER_EMAIL_VALIDATION_ERROR = "";
    $ALERT_USER_REGISTER_EMAIL_VALIDATION_LINK_ERROR = "";
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

// Envoie du lien permettant à l'utilisateur de réinitialiser son mot de passe
function getUserResetPasswordSendLinkView() {
    $title = "Réinitialisation mot de passe";
    $description = "Envoie du lien de réinitialisation du mot de passe";
    $ALERT_USER_RESET_PASSWORD_LINK_SENT = "";
    $ALERT_USER_RESET_PASSWORD_LINK_SENT_ERROR = "";
    $ALERT_USER_EMAIL_NOT_EXIST_ERROR = "";
    if (isset($_POST['email']) && !empty($_POST['email'])) {
        $email = $_POST['email'];
        $verifyIfUserExist = getUserByEmail($email);
        if ($verifyIfUserExist > 0) {
            $token = generateToken();
            $result = resetPassword($email, $token);
            if ($result > 0) {
                $to = $email;
                $subject = "Réinitialisation de mot de passe";
                $message = 'Bonjour '.mb_strtoupper($email) . ",". "\r\n" .
                    'Veuillez cliquer sur le lien ci-dessous pour réinitialiser votre mot de passe : '. "\r\n" . "\r\n" .
                    'https://www.house.diouldediallo.fr/aindiaImmo/userResetPassword&email='.$email.'&token='.$token.''. "\r\n";
                $headers = 'From:noreply-rp@aindia.net' . "\r\n";
                mail($to, utf8_decode($subject), utf8_decode($message), $headers);
                $ALERT_USER_RESET_PASSWORD_LINK_SENT = ALERT_USER_RESET_PASSWORD_LINK_SENT . " " .$email;
            } else {
                $ALERT_USER_RESET_PASSWORD_LINK_SENT_ERROR = ALERT_USER_RESET_PASSWORD_LINK_SENT_ERROR;
            }
        }
        if ($verifyIfUserExist <= 0) {
            $ALERT_USER_EMAIL_NOT_EXIST_ERROR = ALERT_USER_EMAIL_NOT_EXIST_ERROR;
        }
    }
    require_once "views/backend/account/sendUserResetPasswordLink.view.php";
}

// Réinitialisation de mot de passe
function getUserResetPasswordView() {
    $title = "Réinitialisation du mot de passe";
    $description = "Réinitialisation du mot de passe";
    $ALERT_USER_RESET_PASSWORD_IS_OK = "";
    $ALERT_USER_EMAIL_NOT_EXIST_ERROR = "";
    $email = $_GET['email'];
    $token = $_GET['token'];
    $updateDate = date("Y-m-d H:i:s");
    $user = verifyIfUserEmailExist($email, $token);
    if ($user > 0) {
        if (isset($_POST['password']) && !empty($_POST['password']) &&
            isset($_POST['passwordConfirmation']) && !empty($_POST['passwordConfirmation'])) {
            $password = $_POST['password'];
            $result = updateUserPassword($email, $password, $updateDate);
            if ($result)
                $ALERT_USER_RESET_PASSWORD_IS_OK = ALERT_USER_RESET_PASSWORD_IS_OK;
        }
    } else {
        $ALERT_USER_EMAIL_NOT_EXIST_ERROR = ALERT_USER_EMAIL_NOT_EXIST_ERROR;
    }
    require_once "views/backend/account/userResetPassword.view.php";
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
