<?php

require_once 'CookieHelper.php';
class PostHandler
{
    // If the submit button is pressed, this code will run
    private static function handleLastNamePostRequest(string $cookieName): string {
        // Remove existing cookie
        CookieHelper::removeCookie($cookieName);

        return $_POST[$cookieName] ?? '';
    }

    public static function requestPost(string $cookieName): string {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            return self::handleLastNamePostRequest($cookieName);
        }
        return '';
    }
}