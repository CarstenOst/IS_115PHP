<?php
include 'InputHandler.php';
include 'InputValidation.php';

// Shared
include '../SharedHtmlRendererM4.php';
include '../Constants.php';

session_start(); // Generally start session before includes, but I wrote the code, so I know it won't echo anything.


/**
 * Renders the page with the form
 *
 * @param array $userInput - optional, if not given, will render the form with empty inputs
 * @return void - echos the html code
 */
function renderPage(array $userInput = []): void
{
    require '../sharedViewTop.php';
    SharedHtmlRendererM4::renderFormArrayBased(  // In Constants.php you can see im using plenty of arrays. ¯\_(ツ)_/¯
        array_keys(INPUT_FIELDS),          // Get the keys from the input fields array
        INPUT_FIELDS,                   // Get the labels for the form
        $userInput,                             // Get the user inputs
    );
}

/**
 * Processes the form with validation and such
 *
 * @return void - echos the html code (by using renderPage() and the generateResponse()).
 */
function processForm(): void
{
    $handler = new InputHandler(); // Instantiate the InputHandler class

    // Dynamically configure input processing rules.
    // This so I can reuse the InputHandler, rather than hard coding it here.
    // Also, im going to use this code for the project, so I want to make it as reusable as possible.
    $handler->addConfig(NAME_COOKIE, [InputValidate::class, 'validateName']);
    $handler->addConfig(EMAIL_COOKIE, [InputValidate::class, 'validateEmail'], [InputValidate::class, 'removeWhiteSpace']);
    $handler->addConfig(NUMBER_COOKIE, [InputValidate::class, 'validatePhoneNumber'], [InputValidate::class, 'removeWhiteSpace']);


    // Process inputs based on configured rules, and store them as dataInput and notValidResponseMessage
    list($dataInput, $notValidResponseMessage) = $handler->processInputs($_POST);

    // If validResponseMessage is not empty, we want to display
    // the content with some kind of response and display the form again.
    // We also stop the execution of the rest of this function, cause it already failed.
    if (!empty($notValidResponseMessage)) {
        SharedHtmlRendererM4::generateResponse($notValidResponseMessage, false);
        renderPage($dataInput);
        return;
    }

    // If we get here, we know that the data is valid, and we can create the success message.
    $validMessage = [ // The task asked for array, and array is given
        "User was successfully registered:",
        "Name: {$dataInput[NAME_COOKIE][0]}",
        "Email: {$dataInput[EMAIL_COOKIE][0]}",
        "Phone number: {$dataInput[NUMBER_COOKIE][0]}"
    ];

    renderPage($dataInput); // Rerender the page with the data from the form. (so we get the success css triggered).
    SharedHtmlRendererM4::generateResponse($validMessage, true); // Generate the success message.

    echo "<br><br>"; // Space between the response and the success message.
    echo implode("<br>", $validMessage); // Echo the success message. To keep it visible for the user.
}


// If the request method is POST, we want to process the form, else we want to render the page with session data if any.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    processForm();
} else {
    renderPage([
        NAME_COOKIE => $_SESSION[NAME_COOKIE] ?? '',
        EMAIL_COOKIE => $_SESSION[EMAIL_COOKIE] ?? '',
        NUMBER_COOKIE => $_SESSION[NUMBER_COOKIE] ?? ''
    ]);
}


// Not really needed as html will close the tags itself, but I like to do it anyway
require '../sharedViewBottom.php';
