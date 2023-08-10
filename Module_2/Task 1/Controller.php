<?php
require_once 'HtmlRenderer.php';
require_once '../PostHandler.php';
require_once '../CookieHandler.php';
require_once 'LastNameFormatting.php';


// I realize that this code is the same as Task 2. You can read the comments there for more info
// But most of this task is in LastNameFormatting.php, PostHandler.php and HtmlRenderer.php. You should read those files for more info too.
$unprocessedUserInput = PostHandler::requestPost(LastNameFormatting::COOKIE_NAME);

if ($unprocessedUserInput) {
    $processedUserInput = LastNameFormatting::capitalizeLastNameAndCount($unprocessedUserInput);
    CookieHandler::set(LastNameFormatting::COOKIE_NAME, json_encode($processedUserInput));
} else {
    $processedUserInput = null;
}

require_once '../sharedViewTop.php';

HtmlRenderer::lastNameFormPrint(LastNameFormatting::COOKIE_NAME);

if ($processedUserInput){
    HtmlRenderer::generateResponse($processedUserInput['lastName']. ' was successfully added', true);
    HtmlRenderer::lastNameInfoPrint($processedUserInput, LastNameFormatting::COOKIE_NAME);
    HtmlRenderer::removeCookieButton();
}
// If there are cookies, I want to be able to see and to remove them
elseif (CookieHandler::isCookie(LastNameFormatting::COOKIE_NAME)){
    HtmlRenderer::lastNameInfoPrint(null, LastNameFormatting::COOKIE_NAME);
    HtmlRenderer::removeCookieButton();
}


require_once '../sharedViewBottom.php';