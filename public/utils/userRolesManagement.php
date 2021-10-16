<?php

// Créer un tableau contenant tous les rôles attribués à l'utilisateur
function getUserRolesArray($arrayRoles): array
{
    $userRoles = array();
    if (count($arrayRoles) > 0) {
        foreach ($arrayRoles as $arrayRole) {
            array_push($userRoles, $arrayRole['name_role']);
        }
    }
    return $userRoles;
}

// Récupérer un rôle par son nom
function getRoleByName($roleName, $arrayRoles): bool
{
    $rolesNamesArray = getUserRolesArray($arrayRoles);
    if (in_array($roleName, $rolesNamesArray, true))
        return true;
    return false;
}

// Vérifier si l'utilisateur a le rôle user
function roleIsUser($arrayRoles): bool
{
    return getRoleByName("user", $arrayRoles);
}

// Vérifier si l'utilisateur a le rôle admin
function roleIsAdmin($arrayRoles): bool
{
    return getRoleByName("admin", $arrayRoles);
}
