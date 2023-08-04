<?php
/*
      /$$$$$$$$                  /$$               /$$
     |__  $$__/                 | $$             /$$$$
        | $$  /$$$$$$   /$$$$$$$| $$   /$$      |_  $$
        | $$ |____  $$ /$$_____/| $$  /$$/        | $$
        | $$  /$$$$$$$|  $$$$$$ | $$$$$$/         | $$
        | $$ /$$__  $$ \____  $$| $$_  $$         | $$
        | $$|  $$$$$$$ /$$$$$$$/| $$ \  $$       /$$$$$$
        |__/ \_______/|_______/ |__/  \__/      |______/

ASCII art stolen here from here: https://patorjk.com/software/taag/#p=display&f=Big%20Money-ne&t=Task%201

Warning, excessive comments below.
*/
class LastNameFormatting
{
    const FORMATTED_NAME = 'formattedLastName';

    private static function countWhitespaces($inputString): int
    {
        // Just to be sure we're not talking to a king
        return preg_match_all('/\s/', $inputString);
    }

    /**
     * Will remove anything that is not a letter in the start of a string
     * Used to support cats helping with typing
     * @param $inputString
     * @return string
     */
    private static function removeNonLetterPrefix($inputString): string
    {
        // Regex to match non-letter characters at the beginning of the string
        // The brackets in the regex means that it will search for anything that does not match with it
        // The "/u" at the end is to enable unicode mode for multibyte characters
        // Note that this does not include all languages. For instance, it does not include some swedish letters,
        // nor other types of alphabets
        preg_match('/^[^a-zA-ZæøåÆØÅ]*/u', $inputString, $matches);

        // It may seem like the variable "$matches" is magic for some,
        // since it does not seem like it returns a value.
        // $matches is accessed by a reference "&", which saves memory and simplifies the code.
        // The reference means that preg_match() function can directly change the variable content.
        // You can find preg_match() in pcre.php on line 160.

        // Get the matched non-letter prefix
        // To explain why I use $matches[0] as an array, we can read the docs;
        // "$matches[0] will contain the text that matched the full pattern,
        // $matches[1] will have the text that matched the first captured parenthesized subpattern, and so on" (source preg_match() docs)
        $nonLetterPrefix = $matches[0];

        // Remove the non-letter prefix from the input string
        return ltrim($inputString, $nonLetterPrefix);
    }

    /**
     * While this method is meant for a last name, it will still work with any names or words.
     * Therefore, the method and variable names could be more generic as the code can be reused.
     * But I will not do this here as it is specific to the task
     * It is also bad practice to do both multiple things in a function,
     * but im making an exception here, as its only counting and making the first char upper case
     * and the fact that I split out some functions for potential reuse and better readability
     * @param string $lastName
     * @return array An associative array containing the formatted last name, length, whitespaces and amount of characters without whitespaces
     */
    public static function capitalizeLastNameAndCount(string $lastName): array
    {
        // If the user did not submit anything, we can predict the output
        // Thus saving resource
        // It is though tempting to create a variable before, as to use it later if the length is not
        // zero. However, the code might later remove all characters if there is no letters provided
        // Read the removeNonLetterPrefix
        if (strlen($lastName) === 0){
            return [
                'lastname' => "",
                'length' => 0
            ];
        }
        // Now I could make another variable, or reuse $lastName to make the next line more readable
        // Example; $lastName = self::removeNonLetterPrefix($lastName). But it will be an extra memory change
        // Meaning it will be less effective
        $formattedLastName = self::capitalizeFirstLetterInWords(self::removeNonLetterPrefix($lastName));
        $length = strlen($formattedLastName);
        $whitespaces = self::countWhitespaces($formattedLastName);

        // Here I return the associative array
        // You must probably by now be like "Why TF are you using an associative array while constantly talking about memory and energy usage?"
        // And you're right, it is of course slightly worse (yet not noticeable in small scale),
        // and it is also way more readable than an index array. However, this is not as bad as
        // creating a variable that is used once like the removal of unwanted letters in the beginning
        return [
            'lastName' => $formattedLastName,
            'length' => $length,
            'whitespaces' => $whitespaces,
            'amountOfChars' => $length - $whitespaces
        ];
    }

    private static function capitalizeFirstLetterInWords($string): string {
        // If you do not have mbstring extention then the program will run ucwords() instead (without UTF-8 :sad-face:)
        // You can fix this by adding mbstring in php.ini
        // Also check your php version
        if (function_exists('mb_convert_case')){
            return mb_convert_case(strtolower($string), MB_CASE_TITLE, 'UTF-8');
        }

        return ucwords(strtolower($string));
    }




    /**
     * POV; you write way too long functions
     * Function just prints out the information about the inputted last name
     * @return void
     */


}