<?php

class PostHandler
{
    /**
     * This function returns the input from the user, if there is any
     * @param string $cookieName The name of the cookie to get user input (note that this is not a set cookie, but from the super global $_POST)
     * @return string
     */
    private static function handlePostRequest(string $cookieName): string {
        return $_POST[$cookieName] ?? '';
    }

    /**
     * This handles the post request, and if there is a cookie and the button is pressed, it removes it
     * @param string $cookieName
     * @return string
     */
    public static function requestPost(string $cookieName): string {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            return self::handlePostRequest($cookieName);
        }
        return '';
    }


    // For task 2
    // The only difference is that I remove the php code from the input as soon as possible
    /**
     * This function returns the input from the user stripped of php and html code, if there is any
     * @param string $cookieName The name of the cookie to get user input
     * @return string
     */
    private static function secureHandleLastNamePostRequest(string $cookieName): string {
        return RemoveCode::removePhpCode($_POST[$cookieName]) ?? '';
    }

    /**
     * This handles the post request, and if there is a cookie and the button is pressed, it removes it
     * @param string $cookieName
     * @return string without php or html code
     */
    public static function secureRequestPost(string $cookieName): string {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            return self::SecureHandleLastNamePostRequest($cookieName);
        }
        return '';
    }
}