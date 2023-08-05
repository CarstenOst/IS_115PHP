<?php
// If you manage to open this file instead of index
if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) {
    header('Location: index.php');
    exit;
}

class CookieHelper
{

    // You do not even want to know how long time I used on this cookie stuff
    public static function hasTargetCookies($cookieToCheck): bool
    {
        $targetCookies = [$cookieToCheck]; // Add names of the cookies, as I go along
        foreach ($targetCookies as $cookieName) {
            if (isset($_COOKIE[$cookieName])) {
                return true;
            }
        }
        return false;
    }

    public static function removeCookie($cookieToRemove): void {
        if (isset($_POST['remove_cookies']) and CookieHelper::hasTargetCookies($cookieToRemove)) {
            unset($_COOKIE[$cookieToRemove]);
            setcookie($cookieToRemove, "", -1, '/');
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit();
        }
    }

    /**
     * @param $cookieToJson
     * @return array|bool
     */
    public static function jsonifyCookieString($cookieToJson): array|bool {
        // More readability at the cost of some memory
        $cookieExists = !empty($_COOKIE[$cookieToJson]);
        if ($cookieExists) {
            // json_decode() can be a little expensive, so we save it in a variable instead
            return json_decode($_COOKIE[$cookieToJson], true);
        }
        return false;
    }
}