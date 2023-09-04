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

$notValidResponseMessage = '';

if ($name and InputValidate::hasNoSpecialCharacters($name)) {
    $notValidResponseMessage .= "$name must have letters, and no numbers or special characters <br>";
}



// If email exists and is not valid
if ($email && !InputValidate::isEmail($email)) {
    $notValidResponseMessage .= "'$email' is not a valid valid email <br>";
}


// Print the notValid response message if it exists
if ($notValidResponseMessage) {
    SharedHtmlRendererM4::generateResponse($notValidResponseMessage, false);
    return;
}

if($name && $email && $phoneNumber) {
    SharedHtmlRendererM4::generateResponse("User was successfully registered <br> Name is: $name <br> Email is: $email <br> Phone number is: $phoneNumber", true);
}

if (InputValidate::hasOnlyNumbers("123")){
    echo "true";
} else {
    echo "false";
}

// Generate Response
echo $name . '<br>';
echo $email . '<br>';
echo $phoneNumber . '<br>';

// Saved in array


require '../sharedViewBottom.php';