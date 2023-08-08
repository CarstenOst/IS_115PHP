<?php
// If you manage to open this file instead of index
if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) {
    header('Location: index.php');
    exit;
}

class CookieHelper
{

    // You do not even want to know how long time I used on this cookie stuff
    /**
     * Checks if there is a cookie set with the name given
     * @param string $cookieToCheck The cookie to check
     * @return bool true if cookie exists, false if cookie does not exist
     */
    public static function isCookie(string $cookieToCheck): bool
    {
        if (isset($_COOKIE[$cookieToCheck])) {
            return true;
        }
        return false;
    }

    /**
     * Removes a cookie
     * @param string $cookieToRemove
     * @return void
     */
    public static function removeCookie(string $cookieToRemove): void {
        unset($_COOKIE[$cookieToRemove]);
        setcookie($cookieToRemove, "", -1, '/');
    }

    /** Sets a cookie
     * @param string $cookieName
     * @param $cookieData
     * @return void
     */
    public static function setCookie(string $cookieName, $cookieData): void {
        setcookie($cookieName, json_encode($cookieData), time() + 3600, "/");
    }

    /**
     * A function to make a cookie into an array
     * @param $cookieToJson
     * @return array|bool
     */
    public static function jsonDecodeCookieString($cookieToJson): array|bool {
        if (self::isCookie($cookieToJson)) {
            return json_decode($_COOKIE[$cookieToJson], true);
        }
        return false;
    }
}