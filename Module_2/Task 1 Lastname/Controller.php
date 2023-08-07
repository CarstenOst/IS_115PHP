<?php
require_once 'LastNameFormatting.php';
require_once 'HtmlRenderer.php';
require_once '../CookieHelper.php';
require_once '../PostHandler.php';


function task1ProcessInput($unprocessedUserInput): array{
    $status = [];
    if ($unprocessedUserInput) {
        // Always validate the input, however I will not do this, because of task 2 going to clean it up
        // if (preg_match("/^[a-zA-Z-' ]*$/", $input)) <- (this is how it can be stopped)
        $formattedLastName = LastNameFormatting::capitalizeLastNameAndCount($unprocessedUserInput);
        CookieHelper::setCookie(LastNameFormatting::COOKIE_NAME, $formattedLastName);

        $status = [$formattedLastName, 'green'];
    }

    return $status;
}


$unprocessedUserInput = PostHandler::requestPost(LastNameFormatting::COOKIE_NAME)
;
$processedUserInput = task1ProcessInput($unprocessedUserInput);

require_once '../sharedView.php';

HtmlRenderer::lastNameFormPrint(LastNameFormatting::COOKIE_NAME);

if ($processedUserInput){
    HtmlRenderer::lastNameInfoPrint($processedUserInput[0]);
    HtmlRenderer::cookieButton();
}

// If there are cookies, I want to be able to see and remove them
elseif (CookieHelper::isCookie(LastNameFormatting::COOKIE_NAME)){
    HtmlRenderer::lastNameInfoPrint(null);
    HtmlRenderer::cookieButton();
}

if (!empty($processedUserInput)) {
    echo $response = HtmlRenderer::generateResponse($processedUserInput[0]['lastName']. ' was successfully added', $processedUserInput[1]);
}
