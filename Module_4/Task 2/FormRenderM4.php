<?php

class FormRenderM4
{

    public static function renderForm(
        string $cookieName, string $labelText,
        string $cookieName2, string $labelText2,
        string $cookieName3, string $labelText3)
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
}