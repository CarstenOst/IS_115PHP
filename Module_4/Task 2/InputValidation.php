<?php

class InputValidate
{
    public static function isEmail(string $email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public static function hasNumbers(string $str): bool
    {
        return preg_match('/[0-9]/', $str);
    }

    public static function hasLetters(string $str): bool
    {
        if (!preg_match('/[A-Z]/', strtoupper($str))) {
            return false;
        }
        return true;
    }

    public static function hasOnlyCharactersInAlphabet(string $str): bool
    {
        if (!$str or $str == '\\') {
            return false;
        }
        if (preg_match('#[^A-Z!]#', strtoupper($str))) {
            echo $str;
            return true;
        }
        return false;
    }
}