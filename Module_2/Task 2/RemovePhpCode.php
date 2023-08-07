<?php

class RemoveCode
{
    const COOKIE_NAME = 'noCodeLastName';
    public static function removePhpCode($input): string
    {
        return strip_tags($input);
    }

    public static function removeHtmlCode($input): string
    {
        return htmlentities($input);
    }
}
