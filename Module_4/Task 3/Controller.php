<?php
include '../SharedHtmlRenderer.php';
include '../Task 2/InputHandler.php';
include '../Task 2/InputValidation.php';
include '../Constants.php';

// So since the previous task was total overkill, I'll step down a little bit here.....
session_start();

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
    global $user;
    $oldInput = $_SESSION ?? $user;

    // Instantiate the InputHandler class
    $handler = new InputHandler();

    // Dynamically configure input processing rules.
    // This so I can reuse the InputHandler, rather than hard coding it here.
    $handler->addConfig(NAME_COOKIE, 'strip_tags', [InputValidate::class, 'validateName']);
    $handler->addConfig(EMAIL_COOKIE, [InputValidate::class, 'removeWhiteSpace'], [InputValidate::class, 'validateEmail']);
    $handler->addConfig(NUMBER_COOKIE, [InputValidate::class, 'removeWhiteSpace'], [InputValidate::class, 'validatePhoneNumber']);


    // Process inputs based on configured rules.
    list($dataInput, $notValidResponseMessage) = $handler->processInputs($_POST);

    // To see if anything was changed or not
    $changes = detectChanges($dataInput, $oldInput);
    // If errors or not valid response message is not empty, we want to display the errors and the form again.
    if (!empty($notValidResponseMessage)) {
        SharedHtmlRendererM4::generateResponse($notValidResponseMessage, false);
        renderPageT3($dataInput);
        echo changeMsg($changes);
        return;
    }
    // The task asked for array, and array is given
    $validMessage = [
        "User was successfully registered:",
        "Name: {$dataInput[NAME_COOKIE][0]}",
        "Email: {$dataInput[EMAIL_COOKIE][0]}",
        "Number: {$dataInput[NUMBER_COOKIE][0]}"
    ];

    renderPageT3($dataInput);
    echo changeMsg($changes);
    SharedHtmlRendererM4::generateResponse($validMessage, true);

    echo "<br><br>";
    foreach ($validMessage as $msg) {
        echo $msg . "<br>";
    }
}

function detectChanges(array $processedData, array $originalData): array
{
    $changes = [];

    foreach ($processedData as $field => $data) {
        if (isset($originalData[$field]) && $originalData[$field][0] !== $data[0]) {
            $changes[$field] = [
                'old' => $originalData[$field][0],
                'new' => $data[0]
            ];
        }
    }

    return $changes;
}

function changeMsg(array $changes): string
{
    if (empty($changes)) return '<p>No changes were made.</p>';

    $messages = array_map(function ($field, $data) {
        return "$field: {$data['old']} -> {$data['new']}";
    }, array_keys($changes), $changes);

    return '<br><p>Changed: <br>' . implode("<br>", $messages) . '.</p>';
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
