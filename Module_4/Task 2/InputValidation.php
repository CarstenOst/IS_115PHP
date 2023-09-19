<?php

class InputValidate
{
    /**
     * Checks if string is a valid email
     * @param string $email The email to check
     * @return mixed $email if valid, false if not
     */
    public static function isEmail(string $email): mixed
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    /** Check if str only contains any numbers or "+" symbol
     * @param string $str The string to check for only numbers
     * @return bool true if string only contains numbers or "+" symbol (at first index), false if not
     */
    private static function hasOnlyNumbers(string $str): bool
    {
        return (bool)preg_match('/^\+?[0-9]+$/', $str);
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


    /**
     * Removes whitespace from string
     * @param string $str The string to remove whitespace from
     * @return string The string without whitespace
     */
    public static function removeWhiteSpace(string $str): string
    {
        return preg_replace('/\s+/', '', $str);
    }


    /**
     * Warning reference is used here, so the error message is added to the array given in the parameter
     * @param string $name The name to validate
     * @param array $errorMessage Reference to the array where the error message should be added
     * @return bool true if name is valid, false if not
     */
    public static function validateName(string $name, array &$errorMessage): bool
    {
        if (!self::hasNoSpecialCharacters($name)) {
            $errorMessage[] = "Name can only contain letters. You typed in '$name'";
            return false;
        }
        return true;
    }


    /**
     * Warning reference is used here, so the error message is added to the array given in the parameter
     * @param string $email The email to validate
     * @param array $errorMessage Reference to the array where the error message should be added
     * @return bool true if email is valid, false if not
     */
    public static function validateEmail(string $email, array &$errorMessage): bool
    {
        if (self::isEmail($email)) {
            return true;
        }
        $errorMessage[] = "Email: '$email' is not valid";
        return false;
    }


    /**
     * Warning reference is used here, so the error message is added to the array given in the parameter
     * @param string $str The string to validate
     * @param array $errorMessage Reference to the array where the error message should be added
     * @return bool true if string is valid, false if not
     */
    public static function validatePhoneNumber(string $str, array &$errorMessage): bool
    {
        if (!self::hasOnlyNumbers($str)) {
            $errorMessage[] = 'Phone number can only contain numbers and "+" symbol in the beginning';
            return false;
        }
        // Let's assume that company or special numbers are not allowed to be used as a phone number (110, 112, 113 etc.)
        if (strlen($str) < 8 || strlen($str) > 14) {
            $errorMessage[] = 'Phone number must be between 8 and 14 characters long';
            return false;
        }
        return true;
    }
}
