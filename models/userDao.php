<?php
// Importation des Fichiers
require_once "config/config.php";
require_once "pdo.php";



function registerUserOnDatabase($username, $email, $password, $token) {
    $database = connexionPDO();
    $query = 'INSERT INTO users (name_user, email_user, password_user, token_user) 
                VALUES (:username, :email, :password, :token)';
    $request = $database->prepare($query);
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    $request->bindValue(":username", $username, PDO::PARAM_STR);
    $request->bindValue(":email", $email, PDO::PARAM_STR);
    $request->bindValue(":password", $passwordHash, PDO::PARAM_STR);
    $request->bindValue(":token", $token, PDO::PARAM_STR);
    $request->execute();
    $result = $database->lastInsertId();
    $request->closeCursor();
    return $result;
}

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


function userRegisterValidation($email) {
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


function loginUser($username, $password) {
    $user = getUserByUsername($username);
    return password_verify($password, $user['password_user']);
}


