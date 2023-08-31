<?php
include 'FormRenderM4.php';
include 'InputValidation.php';
// Shared

include '../SharedHtmlRenderer.php';
include '../PostHandler.php';
require '../sharedViewTop.php';

const NAME_COOKIE = 'Name_Cookie';
const EMAIL_COOKIE = 'Email_Cookie';
const NUMBER_COOKIE = 'PhoneNumber_Cookie';

FormRenderM4::renderForm(
    NAME_COOKIE, 'Enter your name',
    EMAIL_COOKIE, 'Enter Your email',
    NUMBER_COOKIE, 'Enter your number'
);

$name = PostHandlerM4::secureRequestPost(NAME_COOKIE);
$email = PostHandlerM4::secureRequestPost(EMAIL_COOKIE);
$phoneNumber = PostHandlerM4::secureRequestPost(NUMBER_COOKIE);

if ($name and InputValidate::hasOnlyCharactersInAlphabet($name)) {
    SharedHtmlRendererM4::generateResponse("$name must have letters, and no numbers or special characters", false);
}


if ($email) {

    if (InputValidate::isEmail($email)) {
        SharedHtmlRendererM4::generateResponse("$email is valid", true);
        echo $name . '<br>';
        echo $email . '<br>';
        echo $phoneNumber . '<br>';
        return;
    }
    SharedHtmlRendererM4::generateResponse('Email is invalid', false);
}


// Generate Response
// Saved in array


require '../sharedViewBottom.php';