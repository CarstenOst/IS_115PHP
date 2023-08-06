<?php
// TODO remove this comment
// Lag et script som fjerner potensiell HTML- og PHP-kode fra et etternavn. Det behandlede navnet skal
// skrives ut på skjermen




class SerializeString
{
    private static function removePhpCode($input): string
    {
        return strip_tags($input);
    }

    private static function removeHtmlCode($input): string
    {
        return htmlentities($input);
    }

    public static function serializeString($input): string
    {
        $stripped = self::removePhpCode($input);
        return self::removeHtmlCode($stripped);
    }
}
