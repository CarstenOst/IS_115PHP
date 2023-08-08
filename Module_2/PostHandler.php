<?php

class PostHandler
{
    // If the submit button is pressed, this code will run
    private static function handleLastNamePostRequest(string $cookieName): string {
        return $_POST[$cookieName] ?? '';
    }

    public static function requestPost(string $cookieName): string {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Remove existing cookie
            // Ignore the spaghetti, this is not the task anyway :)
            if (isset($_POST['remove_cookies']) and CookieHelper::isCookie($cookieName)) {
                CookieHelper::removeCookie($cookieName);
                return '';
            }
            return self::handleLastNamePostRequest($cookieName);
        }
        return '';
    }


    // For task 2
    // The only difference is that I remove the php code from the input as soon as possible
    private static function secureHandleLastNamePostRequest(string $cookieName): string {
        return RemoveCode::removePhpCode($_POST[$cookieName]) ?? '';
    }

    public static function secureRequestPost(string $cookieName): string {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['remove_cookies']) and CookieHelper::isCookie($cookieName)) {
                CookieHelper::removeCookie($cookieName);
                return '';
            }
            return self::SecureHandleLastNamePostRequest($cookieName);
        }
        return '';
    }
}