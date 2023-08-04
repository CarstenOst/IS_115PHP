<?php
// If you manage to open this file instead of index
if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) {
    header('Location: index.php');
    exit;
}

require_once 'Task_1_Lastname/LastNameFormatting.php';

class CookieHelper
{

    // You do not even want to know how long time I used on this cookie stuff
    public static function hasTargetCookies(): bool
    {
        $targetCookies = [LastNameFormatting::FORMATTED_NAME]; // Add names of the cookies, as I go along
        foreach ($targetCookies as $cookieName) {
            if (isset($_COOKIE[$cookieName])) {
                return true;
            }
        }
        return false;
    }

    public static function cookieButton(): void
    {
        if (self::hasTargetCookies()) {
            echo '<form method="POST">';
            echo '    <button type="submit" name="remove_cookies">Remove All Cookies</button>';
            echo '</form>';
        }
    }
}

