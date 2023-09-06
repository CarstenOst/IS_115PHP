<?php
include 'InputValidation.php';
// Shared
include '../SharedHtmlRenderer.php';
include '../PostHandler.php';
require '../sharedViewTop.php';

const NAME_COOKIE = 'Name_Cookie';
const EMAIL_COOKIE = 'Email_Cookie';
const NUMBER_COOKIE = 'PhoneNumber_Cookie';

$errors = [];
$notValidResponseMessage = [];

SharedHtmlRendererM4::renderFormArrayBased(
    [NAME_COOKIE, EMAIL_COOKIE, NUMBER_COOKIE],
    ['Enter your name*', 'Enter your email*', 'Enter your number*']);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = strip_tags($_POST[NAME_COOKIE]);
    $email = InputValidate::removeWhiteSpace(strip_tags($_POST[EMAIL_COOKIE]));
    $phoneNumber = InputValidate::removeWhiteSpace(strip_tags($_POST[NUMBER_COOKIE]));

    if (empty($name)) {
        $errors['E1'] = "Name is required.";
    }
    if (empty($email)) {
        $errors['E2'] = "Email is required.";
    }
    if (empty($phoneNumber)) {
        $errors['E3'] = "Phone number is required.";
    }

    if ($errors) {
        SharedHtmlRendererM4::generateResponse($errors, false);
        return;
    }

    // If name exists and is not valid
    if (!InputValidate::hasNoSpecialCharacters($name)) {
        $notValidResponseMessage[] = "Name can only contain letters. You typed in '$name'";
    }
    // If email exists and is not valid
    if (!InputValidate::isEmail($email)) {
        $notValidResponseMessage[] = "Email '$email' is not a valid valid email";
    }
    // If phone number exists and is not valid
    if (!InputValidate::hasOnlyNumbers($phoneNumber)) {
        $notValidResponseMessage[] = "Phone number '$phoneNumber' does not have only numbers";
    }


    // Print the notValid response message if it exists
    if ($notValidResponseMessage) {
        SharedHtmlRendererM4::generateResponse($notValidResponseMessage, false);
        return; // Stop execution if any of the information is not valid
    }

    $validMessage[] = "User was successfully registered";
    $validMessage[] = "Name is: $name";
    $validMessage[] = "Email is: $email";
    $validMessage[] = "Phone number is: $phoneNumber";

    SharedHtmlRendererM4::generateResponse($validMessage, true);


    echo "<br><br>";
    foreach ($validMessage as $msg) {
        echo $msg . "<br>";
    }
}


// Saved in array


require '../sharedViewBottom.php';
