<?php

/*
 * Lag et skjema hvor man kan konvertere mellom grader oppgitt i celsius og fahrenheit. Det må gå an å
 * konvertere til og fra begge skalaene.
 */

class TempConverter
{
    /**
     * Converts Celsius temperature to Fahrenheit
     *
     * @param float $celsius
     * @return float temperature in fahrenheit
     */
    public static function celsiusToFahrenheit(float $celsius): float
    {
        return ($celsius * 9.0 / 5.0) + 32.0; // Stolen from Grepper
    }

    /**
     * Converts Fahrenheit temperature to Celsius
     *
     * @param float $fahrenheit
     * @return float temperature in celsius
     */
    public static function fahrenheitToCelsius(float $fahrenheit): float
    {
        return ($fahrenheit - 32.0) * 5.0 / 9.0; // Stolen from Grepper
    }
}
