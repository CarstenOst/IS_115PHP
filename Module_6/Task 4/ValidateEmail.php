<?php

class ValidateEmail
{
    public static function now($email): string|bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

}
