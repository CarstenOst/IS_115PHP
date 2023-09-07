<?php

class InputValidate
{
    public static function isEmail(string $email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) ?? false;
    }

    private static function hasOnlyNumbers(string $str): bool
    {
        // If str only contains any numbers or "+" symbol, return true, else false
        return (bool)preg_match('/^\+?[0-9]+$/', $str);
    }

    public static function validatePhoneNumber(string $str,  &$errorMessage): bool
    {
        if (!self::hasOnlyNumbers($str)) {
            $errorMessage[] .= 'Phone number can only contain numbers and "+" symbol';
            return false;
        }
        // Let's assume that company or special numbers are not allowed to be used as a phone number (110, 112, 113 etc.)
        if (strlen($str) < 8 || strlen($str) > 14) {
            $errorMessage[] .= 'Phone number must be between 8 and 14 characters long';
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
        // Type cast to bool is here redundant, as the not operator is used
        return !preg_match('/[^A-ZÆØÅ ]/iu', $str);
    }

    public static function removeWhiteSpace(string $str): string
    {
        return preg_replace('/\s+/', '', $str);
    }
}
