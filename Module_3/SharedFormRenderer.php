<?php

class SharedFormRenderer
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
}