<?php

if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) {
    header('Location: index.php');
    exit;
}

class SharedHtmlRendererM4
{
    /**
     * Generates a form where you can input stuff
     * @param string $cookieName The name of the cookie to set
     * @param string $labelText The text to display in the label
     * @return void echo the form
     */
    public static function printForm(string $cookieName, string $labelText): void
    {
        // EOT is the open and close identifier, read more on about heredoc on php.net
        // Can be called anything, does not have to be "EOT" (End Of Text)
        echo <<<EOT
            <form id="form" action="" method="POST">
                <label for="$cookieName">$labelText</label><br>
                <input type="text" name="$cookieName" id="$cookieName" required>
                <input id="pointer" type="submit" value="Submit">
            </form>
        EOT;
    }

    /**
     * Generates a form where you can input stuff
     * @param string $cookieName The name of the cookie to set in the super global $_POST
     * @param string $labelText The text to display in the label
     * @param string $secondCookieName The name of the second cookie to set in the super global $_POST
     * @param string $secondLabelText The text to display in the second label
     * @return void
     */
    public static function printTwoInputForms(string $cookieName, string $labelText, string $secondCookieName, string $secondLabelText): void
    {
        // EOT is the open and close identifier, read more on about heredoc on php.net
        // Can be called anything, does not have to be "EOT" (End Of Text)
        echo <<<EOT
            <form class="form-group" id="form" action="" method="POST">
                <label for="$cookieName">$labelText</label><br>
                <input type="text" name="$cookieName" id="$cookieName" required><br>
                <label for="$secondCookieName">$secondLabelText</label><br>
                <input type="text" name="$secondCookieName" id="$secondCookieName" required><br><br>
                <input id="pointer" type="submit" value="Submit">
            </form>
        EOT;
    }

    /**
     * Generate a response with a message and either green or red background.
     * @param mixed $message The message to display. Can be string or array.
     * @param bool $status True for green, false for red color
     * @return void echos the response
     */
    public static function generateResponse(mixed $message, bool $status, int $timeInMilliSeconds = 1200): void
    {
        $color = $status ? 'green' : 'red';
        if (is_array($message)) {
            // Much easier just imploding the array with <br> than looping through it
            $message = implode('<br>', $message);
        }

        echo <<<HTML
            <div id="messageBox" style="background-color: $color; z-index: 9999">
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
                    }, $timeInMilliSeconds)
                }, $timeInMilliSeconds);
            </script>
        HTML;
    }


    /**
     * Renders form based on array input
     * This means that you can render as many input fields you want as long as you have enough memory
     * @param array $cookieNames Fill in as many cookie names that you want
     * @param array $labelText Fill inn as many labels as the amount of cookie names
     * @param array $values Fill in as many values as the amount of cookie names
     * @return void echos the form
     */
    public static function renderFormArrayBased(array $cookieNames, array $labelText, array $values = []): void
    {
        // Return if programmer did not read the docs.
        if (!$cookieNames or count($cookieNames) !== count($labelText)) {
            return;
        }
        // Create the html form tag
        $form = '<form class="form-group" id="form" action="" method="POST">';

        $borderClass = '';
        $borderStyle = 'border-width: 3px !important; ';
        $value = '';
        // Loop through the cookie names and create the input fields with values if any
        foreach ($cookieNames as $cookie) {
            if (!empty($values[$cookie]) && is_array($values[$cookie]) && count($values[$cookie]) >= 2) {
                $borderClass .= $values[$cookie][1] ? 'border border-success' : 'border border-danger';
                // Set value to empty string if not set
                $value = $values[$cookie][0] ?? '';
            }
            $form .= <<<EOT
                <label for="$cookie">{$labelText[$cookie]}</label>
                <input type="text" style="$borderStyle" class="form-control $borderClass" name="$cookie" id="$cookie" value="$value">
            EOT;
        }
        // Concat the rest of the form and input, so we actually can submit our info.
        $form .= <<<EOT
                <br>
                <input id="pointer" type="submit" value="Submit">
            </form>
        EOT;
        // Finally we can just echo it, as returning would allocate more memory
        echo $form;
    }
}
