<?php

class FormRenderM4
{
    /**
     * Renders form based on array input
     * This means that you can render as many input fields you want as long as you have enough memory
     * @param array $cookieNames Fill in as many cookie names that you want
     * @param array $labelText Fill inn as many labels as the amount of cookie names
     * @return void echos the form
     */
    public static function renderFormArrayBased(array $cookieNames, array $labelText): void
    {
        // Return if programmer did not read the docs.
        if (!$cookieNames or count($cookieNames) !== count($labelText)) {
            return;
        }
        // Create the html form tag
        $form = '<form class="form-group" id="form" action="" method="POST">';
        $i = 0;
        foreach ($cookieNames as $cookie) {
            $form .= <<<EOT
                <label for="$cookie">{$labelText[$i++]}</label><br>
                <input type="text" name="$cookie" id="$cookie"><br>
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
