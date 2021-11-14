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

/**
 * Change User Password
 */
function changeUserPassword()
{
    $response = array(
        'status' => 0,
        'message' => ALERT_ACTION_ERROR_COMMON,
    );
    if (isset($_POST['currentPassword']) && !empty($_POST['currentPassword']) &&
        isset($_POST['newPassword']) && !empty($_POST['newPassword']) &&
        isset($_POST['newPasswordConfirmation']) && !empty($_POST['newPasswordConfirmation']))
    {
        $currentPassword = htmlspecialchars($_POST['currentPassword']);
        $newPassword = htmlspecialchars($_POST['newPassword']);
        $updateDate = date("Y-m-d H:i:s");

        if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
            $user = loginUser($_SESSION['name_user'], $currentPassword);
            if ($user) {
                $result = updateUserPassword($_SESSION['email_user'], $newPassword, $updateDate);
                if ($result) {
                    $response['status'] = 1;
                    $response['message'] = ALERT_USER_CHANGE_PASSWORD_IS_OK;
                }
            }
            if (!$user)
                $response['message'] = ALERT_USER_CHANGE_PASSWORD_ERROR;
        } else {
            $response['message'] = ALERT_USER_NOT_LOGIN_ERROR;
        }
    }
    echo json_encode($response);
}

/**
 * Update Email and Username
 */
function updateUserEmailAndUsername() {
    $response = array(
        'status' => 0,
        'message' => ALERT_ACTION_ERROR_COMMON,
    );
    if (isset($_POST['username']) && !empty($_POST['username']) &&
        isset($_POST['email']) && !empty($_POST['email']))
    {
        $username = htmlspecialchars($_POST['username']);
        $email = htmlspecialchars($_POST['email']);
        $updateDate = date("Y-m-d H:i:s");
        if (isset($_SESSION['id']) && !empty($_SESSION['id']))
        {
            $result = updateUsernameAndEmail($_SESSION['id'], $email, $username, $updateDate);
            if ($result) {
                $response['status'] = 1;
                $response['message'] = ALERT_USER_CHANGE_USERNAME_AND_EMAIL_IS_OK;
                $_SESSION['name_user'] = $username;
                $_SESSION['email_user'] = $email;
            }
        } else {
            $response['message'] = ALERT_USER_NOT_LOGIN_ERROR;
        }
    }
    echo json_encode($response);
}


