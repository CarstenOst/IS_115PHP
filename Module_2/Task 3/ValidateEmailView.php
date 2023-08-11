<?php
require_once '../CookieHandler.php';
require_once '../Task 1/HtmlRenderer.php';
class ValidateEmailView
{
    /**
     * Generates the view for the Validate Email task 3
     * @param string $cookieName name of the cookie
     * @param string $input input from user
     * @return void
     */
    public static function generateView(string $cookieName, string $input): void {
        require '../sharedViewTop.php';
        self::displayForm($cookieName, $input);
        self::displayEmail($input);

        // This could be made better. But cookies is not part of the task, so I will leave this logic as it is.
        if (CookieHandler::isCookie($cookieName) or $input) {
            HtmlRenderer::removeCookieButton();
        }
        require '../sharedViewBottom.php';
    }

    /**
     * Displays the form to input email in html.
     * @param string $cookieName The name of the form/post.
     * @param string|null $input If there is an input you want to display in the search field.
     * @return void Echos out the html form.
     */
    public static function displayForm(string $cookieName, ?string $input): void {
        echo <<<HTML
        <form method="post">
            <label for="$cookieName">Enter a valid e-mail:</label>
            <input type="text" name="$cookieName" id="$cookieName" value="$input">
            <input type="submit" value="Submit">
        </form>
        HTML;
    }

    /**
     * Displays the email in html code
     * @param string|null $input The email to display
     * @return void Echos out the email in html tag.
     */
    private static function displayEmail(?string $input): void
    {
        if (!$input) {
            return;
        }
        echo "<p>Your mail is valid: $input</p>";
    }
}