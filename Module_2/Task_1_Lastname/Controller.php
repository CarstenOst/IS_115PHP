<?php

require_once 'LastNameFormatting.php';
require_once 'HtmlRenderer.php';
require_once '../CookieHelper.php';
// If the submit button is pressed, this code will run
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Siddharth was not able to remove cookies, so here you go
    // Also there is some EU rules, but they obviously do not apply to me
    CookieHelper::removeCookie(LastNameFormatting::FORMATTED_NAME_COOKIE);

    if (isset($_POST['string'])) {
        $input = $_POST['string'];
        $formattedLastName = LastNameFormatting::capitalizeLastNameAndCount($input);
        setcookie(LastNameFormatting::FORMATTED_NAME_COOKIE, json_encode($formattedLastName), time() + 3600, "/");
        header('Location: Controller.php');
        exit();
    } else {
        echo "Please enter your last name";
    }
}

require_once '../sharedView.php';

HtmlRenderer::lastNameFormPrint();

// If there are cookies, I want to be able to see and remove them
if (CookieHelper::hasTargetCookies(LastNameFormatting::FORMATTED_NAME_COOKIE)){
    HtmlRenderer::lastNameInfoPrint();
    HtmlRenderer::cookieButton();
}