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
     *
     * @param mixed $message The message to display. Can be string or array.
     * @param bool $status True for green, false for red color
     * @param int $timeAliveInMilliSeconds The time in milliseconds before the response disappears (will be doubled)
     *
     * @return void echos the response
     */
    public static function generateResponse(mixed $message, bool $status, int $timeAliveInMilliSeconds = 1200): void
    {
        $color = $status ? 'green' : 'red';
        if (is_array($message)) {
            $message = implode('<br>', $message); // Implode the array with <br> as "glue".
        }
        // Simple html with javascript to display the message for a short time. Script deletes itself after it has run.
        // Ajax would be better used on the frontend here. And the code could just stay uploaded for the user at all
        // time instead of doing this. This would save some bandwidth.
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
                    }, $timeAliveInMilliSeconds)
                }, $timeAliveInMilliSeconds);
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
        if (!$cookieNames || count($cookieNames) !== count($labelText)) {
            return;
        }
        // Create the html form tag
        $form = '<form class="form-group" id="form" action="" method="POST">';

        $borderClass = '';
        $borderStyle = 'border-width: 3px !important; ';
        $value = '';
        $i = 0; // This is for task 5, so we can loop through an array with int indexes.
        // Loop through the cookie names and create the input fields with values if any
        foreach ($cookieNames as $cookie) {
            if (!empty($values[$cookie]) && is_array($values[$cookie]) && count($values[$cookie]) >= 2) {
                $borderClass .= $values[$cookie][1] ? 'border border-success' : 'border border-danger';
                $value = $values[$cookie][0] ?? ''; // Set value to empty string if not set
            } else if (!empty($values[$i])) { // If array doesn't have int indexes, we want to use the values as normal
                $value = $values[$i++];
            }
            $form .= <<<EOT
                <label for="$cookie">{$labelText[$cookie]}</label>
                <input type="text" style="$borderStyle" class="form-control $borderClass" name="$cookie" id="$cookie" value="$value">
            EOT;
        }
        // Concat the rest of the form and input, so we can submit our info.
        $form .= <<<EOT
                <br>
                <input id="pointer" type="submit" value="Submit">
            </form>
        EOT;

        echo $form; // Finally we can just echo it, as returning would allocate more memory, and it will be used right away.
    }
}
