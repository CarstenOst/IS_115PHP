<?php
include 'ChangeHandler.php';
include '../Constants.php';
include '../SharedHtmlRenderer.php';
// Reuse code from task 2.
include '../Task 2/InputHandler.php';
include '../Task 2/InputValidation.php';

// This code is very similar to task 2. I moved the new logic used to 'ChangeHandler.php'
// Now normally session_start() is called before includes, as if they echo anything the code will possibly halt
// However, I wrote those codes, so I know they won't do that.
session_start();

// Hardcode a global user in an associative array
$user = [
    NAME_COOKIE => ['Kurt Nilsen', true],
    EMAIL_COOKIE => ['kurt@nilsen.com', true],
    NUMBER_COOKIE => ['47283748', true]
];

function renderPageT3($userInput = []): void
{
    include_once '../sharedViewTop.php';
    SharedHtmlRendererM4::renderFormArrayBased(
        array_keys(INPUT_FIELDS),
        INPUT_FIELDS,
        $userInput,
    );
}

function processFormT3(): void
{
    global $user;
    $oldInput = $_SESSION ?? $user;

    // Instantiate the InputHandler class
    $handler = new InputHandler();

    // Dynamically configure input processing rules.
    $handler->addConfig(NAME_COOKIE, 'strip_tags', [InputValidate::class, 'validateName']);
    $handler->addConfig(EMAIL_COOKIE, [InputValidate::class, 'removeWhiteSpace'], [InputValidate::class, 'validateEmail']);
    $handler->addConfig(NUMBER_COOKIE, [InputValidate::class, 'removeWhiteSpace'], [InputValidate::class, 'validatePhoneNumber']);


    // Process inputs based on configured rules.
    list($dataInput, $notValidResponseMessage) = $handler->processInputs($_POST);

    // To see if anything was changed or not
    $changes = ChangeHandler::detectChanges($dataInput, $oldInput);

    // If errors or not valid response message is not empty, we want to display the errors and the form again.
    if (!empty($notValidResponseMessage)) {
        SharedHtmlRendererM4::generateResponse($notValidResponseMessage, false);
        renderPageT3($dataInput);
        echo ChangeHandler::changeMsg($changes);
        return;
    }
    // The task asked for array, and array is given
    $validMessage = [
        "User was successfully registered:",
        "Name: {$dataInput[NAME_COOKIE][0]}",
        "Email: {$dataInput[EMAIL_COOKIE][0]}",
        "Number: {$dataInput[NUMBER_COOKIE][0]}"
    ];

    // Render the page with our new dataInput
    renderPageT3($dataInput);

    // Echo if there has been any changes or not
    echo ChangeHandler::changeMsg($changes);

    // Generate a popup response. This will always be true,
    // as we return before this code if there are errors in the input.
    SharedHtmlRendererM4::generateResponse($validMessage, true);

    echo "<br><br>";
    echo implode("<br>", $validMessage);
}


// Check if submit is pressed
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    processFormT3();
} else if (isset($_SESSION)) {
    renderPageT3([
        NAME_COOKIE => $_SESSION[NAME_COOKIE] ?? '',
        EMAIL_COOKIE => $_SESSION[EMAIL_COOKIE] ?? '',
        NUMBER_COOKIE => $_SESSION[NUMBER_COOKIE] ?? ''
    ]);
    return;
} else {
    renderPageT3($user);
}


require '../sharedViewBottom.php';
