<?php

// If you manage to open this file instead of index
if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) {
    header('Location: ../index.php');
    exit;
}

class HtmlRenderer
{
    /**
     * Generates a button where you can remove the cookie
     * @return void
     */
    public static function removeCookieButton(): void
    {
        echo <<<EOT
            <form method="POST">
                <button id="removeCookieButton" type="submit" name="remove_cookies">Remove Cookies</button>
            </form>
        EOT;
    }

    /**
     * Generates a form where you can input your last name
     * @param string $cookieName The name of the cookie to set
     * @return void echo the form
     */
    public static function lastNameFormPrint(string $cookieName): void
    {
        // EOT is the open and close identifier, read more on about heredoc on php.net
        // Can be called anything, does not have to be "EOT" (End Of Text)
        echo <<<EOT
            <form id="form" action="" method="POST">
                <label for="$cookieName">Enter your last name</label><br>
                <input type="text" name="$cookieName" id="$cookieName" required>
                <input id="pointer" type="submit" value="Submit">
            </form>
        EOT;
    }

    /**
     * This is perhaps one of my uglier functions.
     * Function just prints out the information about the inputted last name
     * @param array|null $data, array must have 'lastName', 'length', 'whitespaces' and 'amountOfChars' keys (yes, I know, I should have used a class)
     * @param string|null $cookieName
     * @return void
     */
    public static function lastNameInfoPrint(?array $data, ?string $cookieName): void
    {
        // If there is no data, but there is a cookie name, we want to try to get the cookie
        if (!$data and $cookieName) {
            // I start to feel the spaghetti now. As this is logic that is not related to the view, it should be in the controller
            // Perhaps make the function have 5 parameters, and then call the function from the controller. But then there is so many parameters
            // Anyway, we decode the data with json_decode. If it fails, we set $data to null
            // This would never happen though, if my controller logic is on point.
            $data = json_decode(CookieHandler::getCookie($cookieName), true) ?? null;
        }
        // Now if there still is no data, we really should throw an error, as this should not be called without data or cookie
        if (!$data){
            $data['lastName'] = 'Error, logic is wrong';
        }

        // This is to see if there is anything in the array
        $lastName = $data['lastName'] ?? '';
        $length = $data['length'] ?? '';
        $whitespaces = $data['whitespaces'] ?? '';
        $amountOfChars = $data['amountOfChars'] ?? '';

        // I use $output and concatenate whatever HTML code I want to echo, and then echo it at the end
        $output = "<p>Last name is: $lastName</p><p>Total length is: $length</p>";

        // If there are whitespaces, I want to echo that too
        if ($whitespaces > 0) {
            $output .= "<p>There are $whitespaces whitespaces</p>";
        }

        // If the length of the last name is not the same as the length of the string, I want to echo that.
        // This means that there are spaces in the string.
        if ($amountOfChars !== $length) {
            $output .= "<p>Amount of characters: $amountOfChars</p>";
        }

        echo $output;

    }

    /**
     * Generates a response box, which is deleted after 1600ms
     * @param $message
     * @param bool $status
     * @return void
     */
    public static function generateResponse($message, bool $status): void {
        $color = $status ? 'green' : 'red';
        echo <<<HTML
    <div id="messageBox" style="background-color: $color">
        $message
    </div>
    <script id="messageScript">
        setTimeout(function() {
            let element = document.getElementById('messageBox');
            element.style.transition = "opacity 1s ease-in-out";
            element.style.opacity = 0;
        
            setTimeout(function() {
                element.parentNode.removeChild(element);
                let scriptElement = document.getElementById('messageScript');
                scriptElement.parentNode.removeChild(scriptElement);
            }, 800);  
        }, 800);
    </script>
    HTML;
    }
}


