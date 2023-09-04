<?php

class InputValidate
{
    public static function isEmail(string $email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) ?? false;
    }

    public static function hasNumbers(string $str): bool
    {
        return preg_match('/[0-9]/', $str);
    }

    public static function hasOnlyNumbers(string $str): bool
    {
        if (!preg_match('/^[0-9\s]+$/', $str)) {
            return false;
        }
        return true;
    }

    public static function hasLetters(string $str): bool
    {
        if (!preg_match('/[A-Z]/', strtoupper($str))) {
            return false;
        }
        return true;
    }

    /**
     * Checks if string has no special characters and only letters (numbers are discarded too)
     * @param string $str
     * @return bool true if string is only letters, false if not
     */
    public static function hasNoSpecialCharacters(string $str): bool
    {
        if (!$str) {
            return false;
        }
        if (preg_match('/[^A-ZÆØÅ ]/iu', $str)) {
            echo $str;
            return true;
        }

        return false;
    }
}