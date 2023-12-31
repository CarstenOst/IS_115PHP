<?php

class Validator
{


    /**
     * This function is made for Module 6, task 5 to validate
     * either an email, password or a phone number in the same function.
     *
     * @param string $type must be string of one of these: text | email | password | phone.
     * @param string $value The string to check if is valid.
     * @return bool True if valid, false if not.
     */
    public static function isValid(string $type, string $value): bool
    {
        $type = strtolower($type);

        return match ($type) {
            'text' => $value != "" && !ctype_space($value) && preg_match("/[a-zA-Z]/", $value),
            'email' => filter_var($value, FILTER_VALIDATE_EMAIL) !== false, // This makes it bool
            'password' => self::validatePassword($value),
            'phone' => preg_match("/^[0-9]{8}$/", $value),
            default => false,
        };
    }

    /**
     * Checks if the password is valid.
     *
     * @param string $password The password to check.
     * @return bool true if the password is valid, false if the password is invalid.
     * TODO make this return an array to give a message of what failed to the user
     */
    private static function validatePassword(string $password): bool
    {
        return strlen($password) >= 9 &&                         // Longer than, or 9 characters.
            preg_match('/(?:.*[0-9]){2}/', $password) && // Has two or more numbers.
            preg_match('/[A-ZÆØÅ]/', $password) &&          // Has one or more upper case letters.
            preg_match('/[a-zøæå]/', $password) &&          // Has one or more lower case letters.
            preg_match('/[^a-zøæåA-ZØÆÅ0-9]/', $password);     // Has one or more special characters.
    }

}
