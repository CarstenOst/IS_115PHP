<?php

class InputValidate
{
    public static function isEmail(string $email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
}