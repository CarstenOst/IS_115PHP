<?php
include '../SharedHtmlRenderer.php';
include '../Task 2/InputHandler.php';
include '../Task 2/InputValidation.php';
include '../Constants.php';

// So since the previous task was total overkill, I'll step down a little bit here


$user = [
    NAME_COOKIE => ['Kurt Nilsen', true],
    EMAIL_COOKIE => ['kurt@nilsen.com', true],
    NUMBER_COOKIE => ['47283748', true]
];


function renderPageT3($userInput = []): void
{
    include_once '../sharedViewTop.php';
    $userKeys = array_keys($userInput);
    SharedHtmlRendererM4::renderFormArrayBased(
        array_keys(INPUT_FIELDS),
        INPUT_FIELDS,
        $userInput,
    );
}

function processFormT3(): void
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
        renderPageT3($dataInput);
        return;
    }

    // The task asked for array, and array is given
    $validMessage = [
        "User was successfully registered:",
        "Name: {$dataInput[NAME_COOKIE][0]}",
        "Email: {$dataInput[EMAIL_COOKIE][0]}",
        "Phone number: {$dataInput[NUMBER_COOKIE][0]}"
    ];

    renderPageT3($dataInput);
    SharedHtmlRendererM4::generateResponse($validMessage, true);

    echo "<br><br>";
    foreach ($validMessage as $msg) {
        echo $msg . "<br>";
    }
}



// Check if submit is pressed
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $changedFields = [];

    // Check if data is changed
    foreach ($user as $key => $value) {
        if (isset($_POST[$key]) && $_POST[$key] !== $value[0]) {
            $user[$key][0] = $_POST[$key];
            $changedFields[] = $key;
        }
    }
    processFormT3();
    if (!empty($changedFields)) {
        // Inform the user
        echo '<br><p>Changes made in the following inputs: <br>' . implode("<br> ", $changedFields) . '.</p>';
    } else {
        echo '<p>No changes were made</p>';
    }
} else {
    renderPageT3($user);
}



require '../sharedViewBottom.php';
