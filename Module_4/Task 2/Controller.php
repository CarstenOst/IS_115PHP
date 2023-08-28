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

echo $name . '<br>';
if ($email) {

    if (InputValidate::isEmail($email)) {
        SharedHtmlRendererM4::generateResponse("$email is valid", true);
        echo $email . '<br>';
        return;
    }
    SharedHtmlRendererM4::generateResponse('Email is not valid', false);
    SharedHtmlRendererM4::generateResponse('Email is not valid', false);
    SharedHtmlRendererM4::generateResponse('Email is not valid', false);
    SharedHtmlRendererM4::generateResponse('Email is not valid', false);
}


echo $phoneNumber . '<br>';


// Generate Response
// Saved in array


require '../sharedViewBottom.php';