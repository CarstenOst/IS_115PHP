<?php

class DateChecker
{
    /**
     * Checks if the given date is out of date
     * @param DateTimeImmutable $givenDate Date string to check
     * @return bool Returns true if the given date is out of date, false otherwise
     * @throws Exception Emits Exception in case of an error
     */
    public static function isOldDate(DateTimeImmutable $givenDate): bool
    {
        // Get current date
        $currentDate = new DateTime();
        // If the given date is less than the current date, it's out of date

        return $givenDate < $currentDate;
    }
}