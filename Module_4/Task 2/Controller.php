<?php
include 'InputValidation.php';
// Shared
include '../SharedHtmlRenderer.php';
include '../PostHandler.php';

session_start();
const NAME_COOKIE = 'Name';
const EMAIL_COOKIE = 'Email';
const NUMBER_COOKIE = 'Number';

function processForm(): void
{
    $fields = [
        NAME_COOKIE => strip_tags($_POST[NAME_COOKIE] ?? ''),
        EMAIL_COOKIE => strip_tags(InputValidate::removeWhiteSpace($_POST[EMAIL_COOKIE] ?? '')),
        NUMBER_COOKIE => strip_tags(InputValidate::removeWhiteSpace($_POST[NUMBER_COOKIE] ?? ''))
    ];

    $errors = [];
    $notValidResponseMessage = [];

    foreach ($fields as $fieldName => $input) {
        if (empty($input)) {
            $errors[$fieldName] = "$fieldName is required.";
        } elseif ($fieldName === NAME_COOKIE && !InputValidate::hasNoSpecialCharacters($input)) {
            $notValidResponseMessage[] = "Name can only contain letters. You typed in '$input'";
        } elseif ($fieldName === EMAIL_COOKIE && !InputValidate::isEmail($input)) {
            $notValidResponseMessage[] = "Email '$input' is not a valid email";
        } elseif ($fieldName === NUMBER_COOKIE && !InputValidate::hasOnlyNumbers($input)) {
            $notValidResponseMessage[] = "Phone number '$input' does not have only numbers";
        } else {
            // If valid, save the input in the session
            $_SESSION[$fieldName] = $input;
        }
    }

    if (!empty($errors) || !empty($notValidResponseMessage)) {
        SharedHtmlRendererM4::generateResponse(array_merge($errors, $notValidResponseMessage), false);
        renderPage($fields);
        return;
    }

    $validMessage = [
        "User was successfully registered with the following information:",
        "Name: {$fields[NAME_COOKIE]}",
        "Email: {$fields[EMAIL_COOKIE]}",
        "Phone number: {$fields[NUMBER_COOKIE]}"
    ];

    renderPage($fields);
    SharedHtmlRendererM4::generateResponse($validMessage, true);

    echo "<br><br>";
    foreach ($validMessage as $msg) {
        echo $msg . "<br>";
    }
}

function renderPage($fields = []) {
    require '../sharedViewTop.php';
    SharedHtmlRendererM4::renderFormArrayBased(
        [NAME_COOKIE, EMAIL_COOKIE, NUMBER_COOKIE],
        ['Enter your name*', 'Enter your email*', 'Enter your number*'],
        $fields
    );
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    processForm();
} else {
    renderPage([
        NAME_COOKIE => $_SESSION[NAME_COOKIE] ?? '',
        EMAIL_COOKIE => $_SESSION[EMAIL_COOKIE] ?? '',
        NUMBER_COOKIE => $_SESSION[NUMBER_COOKIE] ?? ''
    ]);
}




require '../sharedViewBottom.php';
