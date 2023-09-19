<?php
include 'InputValidation.php';
include 'InputHandler.php';

// Shared
include '../SharedHtmlRenderer.php';


session_start();
// I make some constant cookie-variables here, even though they should be used in EventUser.php and included here
// But then I would have to write EventUser::XXXXX_COOKIE, and I don't want to do that, as it makes the code longer, yet
// arguably more reusable
const NAME_COOKIE = 'Name';
const EMAIL_COOKIE = 'Email';
const NUMBER_COOKIE = 'Number';


function renderPage($userInput = []): void
{
    require '../sharedViewTop.php';
    SharedHtmlRendererM4::renderFormArrayBased(
        [NAME_COOKIE, EMAIL_COOKIE, NUMBER_COOKIE],
        [NAME_COOKIE => 'Enter your name*', EMAIL_COOKIE => 'Enter your email*', NUMBER_COOKIE => 'Enter your number*'],
        $userInput,
    );
}

function processForm(): void
{
    // Instantiate the InputHandler class
    $handler = new InputHandler();

    // Dynamically configure input processing rules.
    // This so I can reuse the InputHandler, rather than hard coding it here.
    $handler->addConfig(NAME_COOKIE, 'strip_tags', [InputValidate::class, 'validateName']);
    $handler->addConfig(EMAIL_COOKIE, [InputValidate::class, 'removeWhiteSpace'], [InputValidate::class, 'validateEmail']);
    $handler->addConfig(NUMBER_COOKIE, [InputValidate::class, 'removeWhiteSpace'], [InputValidate::class, 'validatePhoneNumber']);


    // Process inputs based on configured rules.
    list($dataInput, $notValidResponseMessage) = $handler->processInputs($_POST);

    // If errors or not valid response message is not empty, we want to display the errors and the form again.
    if (!empty($notValidResponseMessage)) {
        SharedHtmlRendererM4::generateResponse($notValidResponseMessage, false);
        renderPage($dataInput);
        return;
    }

    // The task asked for array, and array is given
    $validMessage = [
        "User was successfully registered:",
        "Name: {$dataInput[NAME_COOKIE][0]}",
        "Email: {$dataInput[EMAIL_COOKIE][0]}",
        "Phone number: {$dataInput[NUMBER_COOKIE][0]}"
    ];

    renderPage($dataInput);
    SharedHtmlRendererM4::generateResponse($validMessage, true);

    echo "<br><br>";
    foreach ($validMessage as $msg) {
        echo $msg . "<br>";
    }
}


// If the request method is POST, we want to process the form, else we want to render the page with session data if any
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
