<?php
// The require_once keyword is used to include a file only once. If we use require_once more than once, it will not include the file again.
// I had some issues with some files being included more than once, so I went full on require_once.
// The reason for that was that I used include or require in some of the other classes being included here.
// I solved it by reducing my spaghetti (highly coupled) code in the included classes.
// Require is essentially the same as include, but it will throw an error if the file is not found. While include will only throw a warning.
// Error will stop the script, while warning will not.
require 'HtmlRenderer.php';
require '../PostHandler.php';
require '../CookieHandler.php';
require 'LastNameFormatting.php';



// Most of this task is found in LastNameFormatting.php. And I made some handlers such as PostHandler.php and HtmlRenderer.php.

// Here we get input from the user
$unprocessedUserInput = PostHandler::requestPost(LastNameFormatting::COOKIE_NAME);

// If there is input provided from the form, we format the input and set a cookie.
// Note that capitalizeLastNameAndCount() will return an array, so we need to convert it to a string that can be stored in a cookie
// Hence the use of json_encode()
if ($unprocessedUserInput) {
    $processedUserInput = LastNameFormatting::capitalizeLastNameAndCount($unprocessedUserInput);
    CookieHandler::set(LastNameFormatting::COOKIE_NAME, json_encode($processedUserInput));
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
HtmlRenderer::lastNameFormPrint(LastNameFormatting::COOKIE_NAME, 'Enter your last name');


// If there is user input, I want to see it. I also want to see the remove cookie button
if ($processedUserInput) {
    HtmlRenderer::generateResponse($processedUserInput['lastName'] . ' was successfully added', true);
    HtmlRenderer::lastNameInfoPrint($processedUserInput, LastNameFormatting::COOKIE_NAME);
    HtmlRenderer::removeCookieButton();
}
// If there are cookies and no input, I want to be able to see and to remove them
elseif (CookieHandler::isCookie(LastNameFormatting::COOKIE_NAME)) {
    HtmlRenderer::lastNameInfoPrint(null, LastNameFormatting::COOKIE_NAME);
    HtmlRenderer::removeCookieButton();
}

// Here we end the html page, it is not actually needed, as html will close the tags for us anyway
require_once '../sharedViewBottom.php';