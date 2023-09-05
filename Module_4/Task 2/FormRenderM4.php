<?php

class FormRenderM4
{
    /**
     * This function is now deprecated, as it is hardcoded to always need 3 inputs of both cookienames and labeltext
     * @param string $cookieName
     * @param string $labelText
     * @param string $cookieName2
     * @param string $labelText2
     * @param string $cookieName3
     * @param string $labelText3
     * @return void
     */
    public static function renderForm(
        string $cookieName, string $labelText,
        string $cookieName2, string $labelText2,
        string $cookieName3, string $labelText3): void
    {

        echo <<<EOT
            <form class="form-group" id="form" action="" method="POST">
                
                <label for="$cookieName">$labelText</label><br>
                <input type="text" name="$cookieName" id="$cookieName" required><br>
                
                <label for="$cookieName2">$labelText2</label><br>
                <input type="text" name="$cookieName2" id="$cookieName2" required><br>
                
                <label for="$cookieName3">$labelText3</label><br>
                <input type="text" name="$cookieName3" id="$cookieName3" required><br><br>
                <input id="pointer" type="submit" value="Submit">
            </form>
        EOT;
    }

    /**
     * Renders form based on array input
     * This means that you can render as many input fields you want as long as you have enough memory
     * @param array $cookieNames Fill in as many cookie names that you want
     * @param array $labelText Fill inn as many labels as the amount of cookie names
     * @return void echos the form
     */
    public static function renderFormArrayBased(array $cookieNames, array $labelText): void
    {
        if (!$cookieNames) {
            return;
        }
        $form = '<form class="form-group" id="form" action="" method="POST">';
        $i = 0;
        foreach ($cookieNames as $cookie) {
            $form .= <<<EOT
                <label for="$cookie">$labelText[$i]</label><br>
                <input type="text" name="$cookie" id="$cookie"><br>
            EOT;
            $i++;
        }
        // Concat the rest of the form, so we actually can submit our info
        $form .= <<<EOT
                <br>
                <input id="pointer" type="submit" value="Submit">
            </form>
            EOT;

        echo $form;
    }
}
