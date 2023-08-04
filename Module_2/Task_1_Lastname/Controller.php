<?php

require_once 'LastNameFormatting.php';
require_once 'HtmlRenderer.php';
require_once '../CookieHelper.php';
// If the submit button is pressed, this code will run
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['remove_cookies'])) {
        if (CookieHelper::hasTargetCookies()) {

            unset($_COOKIE[LastNameFormatting::FORMATTED_NAME]);
            setcookie(LastNameFormatting::FORMATTED_NAME, "", -1, '/');
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit();

        }
    }

    if (isset($_POST['string'])) {
        $input = $_POST['string'];
        $formattedLastName = LastNameFormatting::capitalizeLastNameAndCount($input);
        setcookie(LastNameFormatting::FORMATTED_NAME, json_encode($formattedLastName), time() + 3600, "/");
        header('Location: Controller.php');
        exit();
    } else {
        echo "Please enter your last name";
    }
}


require_once '../sharedView.php';

HtmlRenderer::lastNameFormPrint();
HtmlRenderer::lastNameInfoPrint();