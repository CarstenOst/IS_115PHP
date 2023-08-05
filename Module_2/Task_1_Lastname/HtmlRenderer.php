<?php

// If you manage to open this file instead of index
if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) {
    header('Location: ../index.php');
    exit;
}

class HtmlRenderer
{
    public static function cookieButton(): void
    {
        echo <<<EOT
            <script>
                let cookieDiv = document.getElementById("content");
                cookieDiv.innerHTML += `
                    <form method="POST">
                    <button type="submit" name="remove_cookies">Remove All Cookies</button>
                    </form>`;
            </script>
        EOT;
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

    /**
     * POV; you write way too long functions
     * Function just prints out the information about the inputted last name
     * @return void
     */
    public static function lastNameInfoPrint(): void
    {
        $data = CookieHelper::jsonifyCookieString(LastNameFormatting::FORMATTED_NAME_COOKIE);
        if (!$data){
            echo 'Error when displaying cookie, seek help from the dev';
        }

        // This is to see if there is anything in the array
        $lastName = $data['lastName'] ?? '';
        $length = $data['length'] ?? '';
        $whitespaces = $data['whitespaces'] ?? '';
        $amountOfChars = $data['amountOfChars'] ?? '';

        // phpStorm has some whiny inspections, so im going to ignore it for the following statement
        // as I do not want to disable inspections completely
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