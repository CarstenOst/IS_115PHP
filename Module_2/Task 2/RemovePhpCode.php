<?php

class RemoveCode
{
    const COOKIE_NAME = 'noCodeLastName';

    /**
     * Removes php and html code from the input
     * @param string $input The input to remove code from
     * @return string The input without php and html code
     */
    public static function removePhpCode(string $input): string
    {
        return strip_tags($input);
    }
}
