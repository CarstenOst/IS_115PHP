<?php

class PasswordGenerator
{
    // Random, with minimum 8 characters. At least one number, and one upper (and lower) case letter.
    private static function passwordGenerator($length = 8): string {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()-_=+[]{}|;:,.<>?';
        $password = '';
        // We need to know the max length of the characters string as to not try to look up an index that does not exist
        $max = strlen($characters) - 1;

        // loop at least 8 times
        for ($i = 0; $i < $length; $i++) {
            // get a random number between 0 and the max length of the characters string
            $index = rand(0, $max);
            // add the character at the index to the password string
            $password .= $characters[$index];
        }


        return $password;
    }

    private static function isValid(string $password): bool {
        // check if the password is at least 8 characters long
        if (strlen($password) < 8) {
            return false;
        }

        // check if the password contains at least one number
        if (!preg_match('/[0-9]/', $password)) {
            return false;
        }

        // check if the password contains at least one upper case letter
        if (!preg_match('/[A-Z]/', $password)) {
            return false;
        }

        // check if the password contains at least one lower case letter
        if (!preg_match('/[a-z]/', $password)) {
            return false;
        }

        return true;
    }


    public static function getValidPassword(int $length = 8): string {
        $maxAttempts = 100;
        do {
            $password = self::passwordGenerator($length);
        } while (!self::isValid($password) and $maxAttempts-- > 0);

        if ($maxAttempts <= 0) {
            return 'Could not generate a valid password, try increasing the password length';
            //throw new Exception('Could not generate a valid password');
        }
        return $password;
    }
}