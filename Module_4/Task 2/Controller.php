<?php
include 'InputValidation.php';
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
    $dataInput = [
        NAME_COOKIE => [strip_tags($_POST[NAME_COOKIE]), true],
        EMAIL_COOKIE => [strip_tags(InputValidate::removeWhiteSpace($_POST[EMAIL_COOKIE])), true],
        NUMBER_COOKIE => [strip_tags(InputValidate::removeWhiteSpace($_POST[NUMBER_COOKIE])), true]
    ];

    $notValidResponseMessage = [];
    foreach ($dataInput as $dataInputKey => $input) {
        if (empty($input[0])) {
            $notValidResponseMessage[] = "$dataInputKey is required.";
            $dataInput[$dataInputKey][1] = false;
        } elseif ($dataInputKey === NAME_COOKIE && !InputValidate::hasNoSpecialCharacters($input[0])) {
            $notValidResponseMessage[] = "Name can only contain letters. You typed in '$input[0]'";
            $dataInput[$dataInputKey][1] = false;
        } elseif ($dataInputKey === EMAIL_COOKIE && !InputValidate::isEmail($input[0])) {
            $notValidResponseMessage[] = "Email '$input[0]' is not a valid email";
            $dataInput[$dataInputKey][1] = false;
        }

        // Now here I would have to add a lot of code if im not handling the next code with a pointer.
        // So I use a pointer (well it's technically called a reference in php, as this is not C(++)
        // so we can only simulate a pointer-like-behaviour by using "&") to add the error message
        // to the array given in the parameter instead of initiating extra variables.
        // This is also done to give more accurate error messages.
        // I do think I should have done it with the others too, but this is just for learning purposes.
        // And it works fine, so I will not change it.
        elseif ($dataInputKey === NUMBER_COOKIE && !InputValidate::validatePhoneNumber($input[0], $notValidResponseMessage)) {
            $dataInput[$dataInputKey][1] = false;
        }
        // Save the input in the session, even if it is not valid
        $_SESSION[$dataInputKey] = $input;
    }
    // If errors or not valid response message is not empty, we want to display the errors and the form again
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
