<?php

class Validate
{
    CONST COOKIE_NAME = 'email';

    /**
     * Checks if an email is valid.
     * @param string $email The email to check.
     * @return bool True if email is valid, false if not.
     */
    public static function email(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
}