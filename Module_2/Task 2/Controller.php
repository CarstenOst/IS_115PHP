<?php
require_once 'RemovePhpCode.php';
require_once '../PostHandler.php';
require_once '../CookieHandler.php';
require_once '../Task 1/HtmlRenderer.php';
require_once '../Task 1/LastNameFormatting.php';

/**
 * Note that this task (2) has a lot of similarities with task 1. The comments and code will be similar.
 * If you have read the comments in task 1, you can read the first comments above the initiation
 * of $noCodeUserInput, and then skip the rest, as it is identical with only cookie name changed.
 */


// The main difference from task 1, where I call secureRequestPost instead of requestPost
// The secureRequestPost function will remove php and html code from the input
// It also has some hidden features, like removing the cookie, if the remove cookie button is pressed
// This is not the best way to do it, as it hides the functionality, but I will hopefully learn more about this in a later module
$noCodeUserInput = PostHandler::secureRequestPost(RemoveCode::COOKIE_NAME);


// If there is an input, we then format the input here same as in task 1, and set a cookie of the formatted text
// The task did not specify this, but hey, why not format it when the code is made already?
if ($noCodeUserInput) {
    $processedUserInput = LastNameFormatting::capitalizeLastNameAndCount($noCodeUserInput);
    // Since the cookie can only store strings, we need to convert the array to a string
    // We do this by using json_encode()
    CookieHandler::set(RemoveCode::COOKIE_NAME, json_encode($processedUserInput));
} else {
    // If there is no input, we set the processed user input to null
    $processedUserInput = null;
}

// Here we start building the top of the html page
// You can notice that the code above will run without getting any input first time
// Which I think can be handled earlier, but I will not do that now
// The line underneath cannot be above the code above, because we need to set the cookie first, and the header must be set before any output
// There are ways to do this differently, which hopefully are better.
require_once '../sharedViewTop.php';

// Display the form, which gets the cookie name as a parameter
HtmlRenderer::lastNameFormPrint(RemoveCode::COOKIE_NAME, 'Enter your last name (more secure)');


// If there is user input, I want to see it. I also want to see the remove cookie button
if ($processedUserInput) {
    HtmlRenderer::generateResponse($processedUserInput['lastName'] . ' was successfully added', true);
    HtmlRenderer::lastNameInfoPrint($processedUserInput, RemoveCode::COOKIE_NAME);
    HtmlRenderer::removeCookieButton();
}
// If there is no input but there are cookies, I want to be able to see and remove them
elseif (CookieHandler::isCookie(RemoveCode::COOKIE_NAME)) {
    HtmlRenderer::lastNameInfoPrint(null, RemoveCode::COOKIE_NAME);
    HtmlRenderer::removeCookieButton();
}

// Here we end the html page, it is not actually needed, as html will close the tags for us anyway
require_once '../sharedViewBottom.php';