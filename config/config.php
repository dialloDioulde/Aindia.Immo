<?php

const COLOR_TITLE_LEVEL_A_INTERIM = "my_ColorGreen";

const COLOR_TITLE_LEVEL_A_INTERIM_TEAM = "my_ColorGreen";

// Constantes liées à la Connexion de la Base De Données
/*

const HOST_NAME = "dioulddiallo.mysql.db";
const DATABASE_NAME = "dioulddiallo";
const USER_NAME = "dioulddiallo";
const PASSWORD = "Maria9512Sehawa";
*/

const HOST_NAME = "localhost";
const DATABASE_NAME = "Aindia";
const USER_NAME = "root";
const PASSWORD = "root";

const COOKIE_PROTECT = "hersougool";


// Constantes liées aux utilisateurs
const ALERT_USER_REGISTER_EMAIL_VALIDATION_MESSAGE = "Un lien de validation de votre inscription vient de vous être envoyé à votre adresse email";
const ALERT_USER_REGISTER_EMAIL_VALIDATION_ERROR_MESSAGE = "Une erreur s'est produite lors de l'envoie du lien de validation de votre inscription";
const ALERT_USER_REGISTER_ERROR = "Une erreur s'est produite lors de la création de votre compte";
const ALERT_USER_REGISTER_USERNAME_ERROR = "Pseudo déjà utilissé par un autre utilisateur";
const ALERT_USER_REGISTER_EMAIL_ERROR = "Adresse email déjà utilisée par un autre utilisateur";
const ALERT_USER_NOT_LOGIN_ERROR = "Vous n'êtes pas connecté(e) à votre compte utilisateur";

const ALERT_USER_LOGIN_WELCOME = "Bienvenue, nous sommes content de vous revoir !";
const ALERT_USER_LOGIN_ERROR = "Mot de passe ou Nom d'utilisateur Invalide";


// Constantes lées aux offres
const ALERT_OFFER_CREATE = "Votre Offre a bien été créée";
const ALERT_OFFER_CREATE_ERROR = "Une erreur est survenue lors de l'enregistrement des informations saisies";
const ALERT_OFFER_CREATE_INSERT_IMAGE_TO_DATABASE_ERROR ="Une erreur est survenue lors de la création de votre offre";
const ALERT_OFFER_CREATE_UPLOAD_FILE_ERROR = "L'ajout de l'image n'a pas fonctionné";
const ALERT_OFFER_CREATE_FILE_EXIST_ERROR = "Le fichier existe déjà";
const ALERT_OFFER_CREATE_FILE_EXTENSION_ERROR = "Seules les extensions png, jpeg, jpg sont autorisées";
const ALERT_OFFER_CREATE_NUMBER_OF_IMAGES = "Vous devez chosir au moins 4 images";
const ALERT_OFFER_UPDATE = "Votre offre a bien été mise à jour";
const ALERT_OFFER_UPDATE_ERROR = "Une érreur est survenue lors de mise à jour de votre offre";



// Récupération du Chemin Absolu
define("URL", str_replace("index.php", "", (isset($_SERVER["HTTPS"]) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]"));

/*
 $addImageResponse = array(
    'status' => 0,
    'A_O_C' => ALERT_OFFER_CREATE,
    'A_O_U' => ALERT_OFFER_UPDATE,
    'A_O_C_I_I_TO_D_E' => ALERT_OFFER_CREATE_INSERT_IMAGE_TO_DATABASE_ERROR,
    'A_O_C_U_F_E' => ALERT_OFFER_CREATE_UPLOAD_FILE_ERROR,
    'A_O_C_F_EXI_E' => ALERT_OFFER_CREATE_FILE_EXIST_ERROR,
    'A_O_C_F_EXT_E' => ALERT_OFFER_CREATE_FILE_EXTENSION_ERROR,
    'data' => '',
);
 */

?>
