<?php

/**
 * Class TempConverter.
 * Contains static functions to convert temperature from Celsius to Fahrenheit and vice versa.
 */
class TempConverter
{
    /**
     * Converts Celsius temperature to Fahrenheit
     *
     * @param float|int $celsius
     * @return float temperature in fahrenheit
     */
    public static function celsiusToFahrenheit(float|int $celsius): float
    {
        return ($celsius * 9.0 / 5.0) + 32.0; // Stolen from Grepper (chrome extension).
    }

    /**
     * Converts Fahrenheit temperature to Celsius
     *
     * @param float $fahrenheit
     * @return float temperature in celsius
     */
    public static function fahrenheitToCelsius(float $fahrenheit): float
    {
        return ($fahrenheit - 32.0) * 5.0 / 9.0; // Stolen from Grepper (chrome extension).
    }
}
