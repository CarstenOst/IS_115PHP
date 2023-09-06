<?php

class InputValidate
{
    public static function isEmail(string $email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) ?? false;
    }

    public static function hasOnlyNumbers(string $str): bool
    {
        // If str only contains any numbers or "+" symbol, return true, else false
        return (bool)preg_match('/^[0-9\s+]+$/', $str);
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
