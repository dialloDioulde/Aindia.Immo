<?php
// Pour Sécuriser les Informations passées avec $GET et $POST
class Security {
    public static function securityHtml($string): string
    {
        return htmlentities($string);
    }

    public static function generateCookiePassword() {
        $cookie = session_id().microtime().rand(0,999999);
        $cookie = hash("sha512", $cookie);
        setcookie(COOKIE_PROTECT, $cookie, time() + (60 * 20));
        $_SESSION[COOKIE_PROTECT] = $cookie;
    }

    public static function verifyCookie(): bool
    {
        if ($_COOKIE[COOKIE_PROTECT] === $_SESSION[COOKIE_PROTECT]) {
            Security::generateCookiePassword();
            return true;
        } else {
            session_destroy();
            throw new Exception("Vous n'avez pas le droit d'accéder à cette page !");
        }
    }
}
