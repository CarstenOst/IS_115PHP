<?php

require_once 'CookieHelper.php';
class PostHandler
{
    // If the submit button is pressed, this code will run
    private static function handleLastNamePostRequest(string $cookieName): string {
        // Remove existing cookie
        // Ignore the spaghetti, this is not the task anyway :)
        // TODO MOVE COOKIEHELPER OUT OF THIS CLASS
        CookieHelper::removeCookie($cookieName);

        return $_POST[$cookieName] ?? '';
    }

    public static function requestPost(string $cookieName): string {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            return self::handleLastNamePostRequest($cookieName);
        }
        return '';
    }


    // For task 2
    private static function secureHandleLastNamePostRequest(string $cookieName): string {
        CookieHelper::removeCookie($cookieName);

        return RemoveCode::removePhpCode($_POST[$cookieName]) ?? '';
    }

    public static function secureRequestPost(string $cookieName): string {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            return self::SecureHandleLastNamePostRequest($cookieName);
        }
        return '';
    }
}