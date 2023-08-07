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
                    <button id="pointer" type="submit" name="remove_cookies">Remove Cookies</button>
                    </form>`;
            </script>
        EOT;
    }

    public static function lastNameFormPrint(string $cookieName): void
    {
        // EOT is the open and close identifier, read more on about heredoc on php.net
        // Can be called anything, does not have to be "EOT" (End Of Text)
        echo <<<EOT
            <script>
                let myDiv = document.getElementById("content");
                myDiv.innerHTML += `
                    <form id="form" action="" method="POST">
                        <label for="$cookieName">Enter your last name</label><br>
                        <input type="text" name="$cookieName" id="$cookieName" required>
                        <input id="pointer" type="submit" value="Submit">
                    </form>`;
            </script>
        EOT;
    }

    /**
     * POV; you write way too long functions
     * Function just prints out the information about the inputted last name
     * @return void
     */
    public static function lastNameInfoPrint(?array $data, ?string $cookieName): void
    {
        if (!$data and $cookieName) {
            // I start to feel the spaghetti now
            $data = CookieHelper::jsonifyCookieString($cookieName) ?? null;
        }

        if (!$data){
            $data['lastName'] = 'Error, logic is wrong';
        }

        // This is to see if there is anything in the array
        $lastName = $data['lastName'] ?? '';
        $length = $data['length'] ?? '';
        $whitespaces = $data['whitespaces'] ?? '';
        $amountOfChars = $data['amountOfChars'] ?? '';

        $output = "
        <script>
            let myOtherDiv = document.getElementById('content');
            myOtherDiv.innerHTML += '<p>Last name is: $lastName</p><p>Total length is: $length</p>';";

        if ($whitespaces > 0) {
            $output .= "myOtherDiv.innerHTML += '<p>There are $whitespaces whitespaces</p>';";
        }

        if ($amountOfChars !== $length) {
            $output .= "myOtherDiv.innerHTML += '<p>Amount of characters: $amountOfChars</p>';";
        }

        $output .= "</script>";

        echo $output;

    }

    public static function generateResponse($message, $status): string {
        $color = $status ? 'green' : 'red';

        return <<<HTML
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


