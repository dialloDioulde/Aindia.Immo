<?php

// Génération de token
function generateToken()
{
    $str = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $token = '';
    for ($i = 0; $i < 20; $i++) {
        $token .= $str[rand(0, strlen($str) - 1)];
    }
    return $token;
}
