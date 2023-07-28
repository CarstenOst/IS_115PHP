<?php echo 'Task 1';

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

    // Just to be sure we're not talking to a king
    private static function countWhitespaces($inputString): int
    {
        return preg_match_all('/\s/', $inputString);
    }

    /**
     * Will remove anything that is not a letter in ht
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

        // Since it may seem like the variable $matches is magic for some,
        // since it does not seem like it returns a value.
        // $matches is accessed by a reference "&", which saves memory and simplifies the code.
        // The reference means that preg_match() function can directly change the variable content.
        // You can find preg_match() in pcre.php on line 160.

        // Get the matched non-letter prefix
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
     * Not to mention that it is only using
     * @param $lastName
     * @return array of last name and the length
     */
    public static function capitalizeLastNameAndCount($lastName): array
    {
        if (!is_string($lastName))
            return [
                'lastName' => 'How did you manage to get this message?',
                'length' => strlen('How did you manage to get this message?')];

        // If the user is a monkey and types anything else than letters, then this function will clean it up;
        $lastName = self::removeNonLetterPrefix($lastName);
        //
        // Here we have function call as a parameter.
        // I first tried using "ucfirst()" which is going to capitalize the first letter (read the docs).
        // But this function cannot handle UTF-8, which means it loses 3 letters from the Norwegian alphabet ("æøå").
        // The same can be said about the"ucwords()" too
        // Therefore, I will use "mb_convert_case()" instead
        // It has a parameter of a function "strtolower($lastName)" which will take a string as a parameter
        // and make all characters of said string to lowercase.
        // The last function to be called has to be the first one to finish because otherwise there would be
        // no value in the parameter for the "mb_convert_case()" function
        $formattedLastName = mb_convert_case(strtolower($lastName), MB_CASE_TITLE, 'UTF-8');
        $length = strlen($formattedLastName);
        $whitespaces = self::countWhitespaces($formattedLastName);

        // Could also make the functions non-static and make some fields, but not today
        return [
            'lastName' => $formattedLastName,
            'length' => $length,
            'whitespaces' => $whitespaces,
            'amountOfChars' => $length - $whitespaces
        ];
    }


    public static function lastNameInfoPrint(): void
    {
        // More readability at the cost of some memory
        $cookieExists = !empty($_COOKIE[self::FORMATTED_NAME]);
        if ($cookieExists) {
            // json_decode() can be a little expensive, so we save it in a variable instead
            $data = json_decode($_COOKIE[self::FORMATTED_NAME], true);

            // This is to see if there is anything in the array
            $lastName = $data['lastName'] ?? '';
            $length = $data['length'] ?? '';
            $whitespaces = $data['whitespaces'] ?? '';
            $amountOfChars = $data['amountOfChars'] ?? '';

            // phpStorm has some whiny inspections, so im going to ignore it for the following statement
            /** @noinspection BadExpressionStatementJS */
            echo <<<EOT
                <script>
                    let myOtherDiv = document.getElementById('content');
                    myOtherDiv.innerHTML += '<p>Last name is: $lastName</p><p>Total length is: $length</p>';
                    if ($whitespaces > 0) {
                        myOtherDiv.innerHTML += '<p>There are $whitespaces whitespaces</p>';
                        }
                    if ($amountOfChars !== $length) {
                        myOtherDiv.innerHTML += '<p>Amount of characters: $amountOfChars</p>';
                        }
                </script>
            EOT;
        }
    }

    public static function lastNameFormPrint(): void
    {
        // EOT is the open and close identifier, read more on about heredoc on php.net
        // Can be called anything, does not have to be "EOT" (End Of Text)
        echo <<<EOT
            <script>
                let myDiv = document.getElementById("content");
                myDiv.innerHTML += `
                    <form id="form" action="" method="POST">
                        <label for="string">Enter your last name</label><br>
                        <input type="text" name="string" id="string" required>
                        <input type="submit" value="Submit">
                    </form>`;
            </script>
        EOT;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['string'])) {
        $input = $_POST['string'];

        $formattedLastName = LastNameFormatting::capitalizeLastNameAndCount($input);

        setcookie(LastNameFormatting::FORMATTED_NAME, json_encode($formattedLastName), time() + 3600, "/");
        header('Location: LastNameFormatting.php');
        exit();
    } else {
        echo "Please enter your last name";
    }
}
// I'm trying different ways of combining a standard html layout
// I still think this is trash, as my code is not bundled inside the specific div I want of the .php included here
// As I have to use JS to access this, it can be complicated for anyone that did not write this code
include 'index.php';

LastNameFormatting::lastNameFormPrint();
LastNameFormatting::lastNameInfoPrint();