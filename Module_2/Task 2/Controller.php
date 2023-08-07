<?php
require_once '../CookieHelper.php';
require_once '../Task 1 Lastname/LastNameFormatting.php';
require_once '../Task 1 Lastname/HtmlRenderer.php';
require_once '../PostHandler.php';

include 'RemovePhpCode.php';
// If the submit button is pressed, this code will run

function processInput($unprocessedUserInput): array{
    $status = [];
    if ($unprocessedUserInput) {
        // Always validate the input, however I will not do this, because of task 2 going to clean it up
        // if (preg_match("/^[a-zA-Z-' ]*$/", $input)) <- (this is one way to stop it)
        $formattedLastName = LastNameFormatting::capitalizeLastNameAndCount($unprocessedUserInput);
        CookieHelper::setCookie(RemoveCode::COOKIE_NAME, $formattedLastName);

        $status = [$formattedLastName, 'green'];
    }

    return $status;
}


function task2Controller(): void
{
    $unprocessedUserInput = PostHandler::secureRequestPost(RemoveCode::COOKIE_NAME);

    $processedUserInput = processInput($unprocessedUserInput);

    require_once '../sharedView.php';

    HtmlRenderer::lastNameFormPrint(RemoveCode::COOKIE_NAME);

    if ($processedUserInput) {

        HtmlRenderer::lastNameInfoPrint($processedUserInput[0], RemoveCode::COOKIE_NAME);
        HtmlRenderer::cookieButton();
    } // If there are cookies, I want to be able to see and remove them
    elseif (CookieHelper::isCookie(RemoveCode::COOKIE_NAME)) {
        HtmlRenderer::lastNameInfoPrint(null, RemoveCode::COOKIE_NAME);
        HtmlRenderer::cookieButton();
    }

    if (!empty($processedUserInput)) {
        echo HtmlRenderer::generateResponse($processedUserInput[0]['lastName'] . ' was successfully added', $processedUserInput[1]);
    }
}

task2Controller();
