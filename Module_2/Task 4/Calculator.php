<?php

class Calculator
{
    /**
     * Calculates the result of the given operation
     * @param int $firstNumber
     * @param string $operator The operator to use. Can be +, -, *, /
     * @param int $secondNumber
     * @return string
     */
    public static function calculate(int $firstNumber, string $operator, int $secondNumber): string
    {
        // The "match" expression is new in PHP 8. It looks cleaner than a switch statement
        return match ($operator) {
            '+' => $firstNumber + $secondNumber,
            '-' => $firstNumber - $secondNumber,
            '*' => $firstNumber * $secondNumber,
            '/' => $firstNumber / $secondNumber,
            default => 'Invalid operator',
        };
    }
}