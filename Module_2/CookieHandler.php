<?php
// If you manage to open this file instead of index
if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) {
    header('Location: index.php');
    exit;
}

class CookieHandler
{
    /**
     * Sets a cookie
     * @param string $cookieName The name of the cookie.
     * @param string $cookieData The data to set.
     * @return void
     */
    public static function set(string $cookieName, string $cookieData): void {
        setcookie($cookieName, $cookieData, time() + 3600, "/");
    }


    /**
     * Checks if there is a cookie set with the name given
     * @param string $cookieToCheck The cookie name to check
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
     * Gets a cookie
     * @param string $cookieName The name of the cookie to get.
     * @return string The cookie data. If cookie does not exist, returns an empty string.
     */
    public static function getCookie(string $cookieName): string {
        return $_COOKIE[$cookieName] ?? '';
    }


    /**
     * Removes a cookie
     * @param string $cookieToRemove The name of the cookie to remove.
     * @return void
     */
    public static function removeCookie(string $cookieToRemove): void {
        unset($_COOKIE[$cookieToRemove]);
        setcookie($cookieToRemove, "", -1, '/');
    }
}