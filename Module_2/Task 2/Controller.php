<?php
ob_start();
require_once '../CookieHelper.php';
require_once '../Task 1 Lastname/LastNameFormatting.php';
require_once '../Task 1 Lastname/HtmlRenderer.php';
// If the submit button is pressed, this code will run



function task2Controller(): void
{

    require_once '../Task 1 Lastname/Controller.php';

    $processedUserInput = Task1Controller::requestPost();

    require_once '../sharedView.php';

    HtmlRenderer::lastNameFormPrint(LastNameFormatting::COOKIE_NAME);

    if ($processedUserInput) {
        HtmlRenderer::lastNameInfoPrint($processedUserInput[0]);
        HtmlRenderer::cookieButton();
    } // If there are cookies, I want to be able to see and remove them
    elseif (CookieHelper::isCookie(LastNameFormatting::COOKIE_NAME)) {
        HtmlRenderer::lastNameInfoPrint(null);
        HtmlRenderer::cookieButton();
    }

    if (!empty($processedUserInput)) {
        echo HtmlRenderer::generateResponse($processedUserInput[0]['lastName'] . ' was successfully added', $processedUserInput[1]);
    }
}

task2Controller();

// Because im a shit programmer and have no idea why the header is already updated
// I'll buy pizza to whoever finds the bug
ob_end_flush();