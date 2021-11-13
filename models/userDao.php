<?php
// Importation des Fichiers
require_once "config/config.php";
require_once "pdo.php";

// Création d'un compte utilisateur
function registerUserOnDatabase($username, $email, $password, $token, $createDate): string
{
    $database = connexionPDO();
    $query = 'INSERT INTO users (name_user, email_user, password_user, token_user, create_date_user) 
                VALUES (:username, :email, :password, :token, :create_date)';
    $request = $database->prepare($query);
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    $request->bindValue(":username", $username, PDO::PARAM_STR);
    $request->bindValue(":email", $email, PDO::PARAM_STR);
    $request->bindValue(":password", $passwordHash, PDO::PARAM_STR);
    $request->bindValue(":token", $token, PDO::PARAM_STR);
    $request->bindValue(":create_date", $createDate, PDO::PARAM_STR);
    $request->execute();
    $result = $database->lastInsertId();
    $request->closeCursor();
    return $result;
}

// Récupérer un utilisateur par son id
function getUserById($userId) {
    $database = connexionPDO();
    $query = 'SELECT * FROM users WHERE id_user = :id_user';
    $request = $database->prepare($query);
    $request->bindValue(":id_user", $userId, PDO::PARAM_INT);
    $request->execute();
    $result = $request->fetch(PDO::FETCH_ASSOC);
    $request->closeCursor();
    return $result;
}

// Récupérer un utilisateur par son pseudo
function getUserByUsername($username) {
    $database = connexionPDO();
    $query = 'SELECT * FROM users WHERE name_user = :username';
    $request = $database->prepare($query);
    $request->bindValue(":username", $username, PDO::PARAM_STR);
    $request->execute();
    $result = $request->fetch(PDO::FETCH_ASSOC);
    $request->closeCursor();
    return $result;
}

// Récupérer un utilisateur par son mail
function getUserByEmail($email) {
    $database = connexionPDO();
    $query = 'SELECT * FROM users WHERE email_user = :email';
    $request = $database->prepare($query);
    $request->bindValue(":email", $email, PDO::PARAM_STR);
    $request->execute();
    $result = $request->fetch(PDO::FETCH_ASSOC);
    $request->closeCursor();
    return $result;
}

// Récupérer un utilisateur par son mail et le tonken généré lors de son inscription
function getUserByEmailAndToken($email, $token) {
    $database = connexionPDO();
    $query = 'SELECT * FROM users WHERE email_user = :email AND token_user = :token';
    $request = $database->prepare($query);
    $request->bindValue(":email", $email, PDO::PARAM_STR);
    $request->bindValue(":token", $token, PDO::PARAM_STR);
    $request->execute();
    $result = $request->fetch(PDO::FETCH_ASSOC);
    $request->closeCursor();
    return $result;
}

// Validation du compte de l'utilisateur
function userRegisterValidation($email): bool
{
    $database = connexionPDO();
    $query = 'UPDATE users SET verified_user = :verified, token_user = :token WHERE email_user = :email';
    $request = $database->prepare($query);
    $request->bindValue(":email", $email, PDO::PARAM_STR);
    $request->bindValue(":verified", 1, PDO::PARAM_INT);
    $request->bindValue(":token", "validated", PDO::PARAM_STR);
    $result = $request->execute();
    $request->closeCursor();
    if ($result > 0) return true;
    return false;
}

// Connexion de l'utilisateur
function loginUser($username, $password): bool
{
    $user = getUserByUsername($username);
    return password_verify($password, $user['password_user']);
}

// Assignation de rôles aux utilisateurs
function userRoleAssignation($userId, $roleId): string
{
    $database = connexionPDO();
    $query = 'INSERT INTO users_roles (id_user, id_role) 
                VALUES (:id_user, :id_role)';
    $request = $database->prepare($query);
    $request->bindValue(":id_user", $userId, PDO::PARAM_STR);
    $request->bindValue(":id_role", $roleId, PDO::PARAM_INT);
    $request->execute();
    $result = $database->lastInsertId();
    $request->closeCursor();
    return $result;
}

// Récupération du ou des rôle(s) de l'utilisateur
function getUserRolesById($userId): array
{
    $database = connexionPDO();
    $query = 'SELECT r.id_role, r.name_role FROM roles r
        INNER JOIN users_roles ur on r.id_role = ur.id_role
        INNER JOIN users u on u.id_user = ur.id_user
        WHERE u.id_user = :id_user
    ';
    $request = $database->prepare($query);
    $request->bindValue(":id_user",$userId,PDO::PARAM_INT);
    $request->execute();
    $usersRoles = $request->fetchAll(PDO::FETCH_ASSOC);
    $request->closeCursor();
    return $usersRoles;
}

// Réinitialisation de mot de passe
function resetPassword($email, $token): string
{
    $database = connexionPDO();
    $query = 'INSERT INTO password_resets (email, token) VALUES (:email, :token)';
    $request = $database->prepare($query);
    $request->bindValue(":email", $email, PDO::PARAM_STR);
    $request->bindValue(":token", $token, PDO::PARAM_STR);
    $request->execute();
    $result = $database->lastInsertId();
    $request->closeCursor();
    return $result;
}

// Vérification de l'existence de l'email utiliser pour la réinitialisation du mot de passe dans la table password_resets
function verifyIfUserEmailExist($email, $token) {
    $database = connexionPDO();
    $query = 'SELECT * FROM password_resets WHERE email = :email AND token = :token';
    $request = $database->prepare($query);
    $request->bindValue(":email", $email, PDO::PARAM_STR);
    $request->bindValue(":token", $token, PDO::PARAM_STR);
    $request->execute();
    $result = $request->fetch(PDO::FETCH_ASSOC);
    $request->closeCursor();
    return $result;
}

// Modification du mot utilisateur
function updateUserPassword($email, $password, $updateDate): bool
{
    $database = connexionPDO();
    $query = 'UPDATE users SET password_user = :password, update_date_user = :update_date    
        WHERE email_user = :email';
    $request = $database->prepare($query);
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    $request->bindValue(":email", $email, PDO::PARAM_STR);
    $request->bindValue(":password", $passwordHash, PDO::PARAM_STR);
    $request->bindValue(":update_date", $updateDate, PDO::PARAM_STR);
    $result = $request->execute();
    $request->closeCursor();
    if ($result > 0) return true;
    return false;
}


function updateUsernameAndEmail($userId, $email, $username, $updateDate): bool
{
    $database = connexionPDO();
    $query = 'UPDATE users SET email_user = :email, name_user = :username, update_date_user = :update_date    
        WHERE id_user = :userId';
    $request = $database->prepare($query);
    $request->bindValue(":userId", $userId, PDO::PARAM_INT);
    $request->bindValue(":email", $email, PDO::PARAM_STR);
    $request->bindValue(":username", $username, PDO::PARAM_STR);
    $request->bindValue(":update_date", $updateDate, PDO::PARAM_STR);
    $result = $request->execute();
    $request->closeCursor();
    if ($result > 0) return true;
    return false;
}
