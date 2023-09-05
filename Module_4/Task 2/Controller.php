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



FormRenderM4::renderFormArrayBased(
    [NAME_COOKIE, EMAIL_COOKIE, NUMBER_COOKIE],
    ['Enter your name*', 'Enter your email*', 'Enter your number*']);

$name = PostHandlerM4::secureRequestPost(NAME_COOKIE);
$email = InputValidate::removeWhiteSpace(PostHandlerM4::secureRequestPost(EMAIL_COOKIE));
$phoneNumber = InputValidate::removeWhiteSpace(PostHandlerM4::secureRequestPost(NUMBER_COOKIE));

if (!$name and !$email and !$phoneNumber) {
    return;
}

if (!$name or !$email or !$phoneNumber) {
    echo 'You need to input data on every input field';
    return;
}

$notValidResponseMessage = '';

// If name exists and is not valid
if (!InputValidate::hasNoSpecialCharacters($name)) {
    $notValidResponseMessage .= "Name '$name' must have letters, and no numbers or special characters <br>";
}
// If email exists and is not valid
if (!InputValidate::isEmail($email)) {
    $notValidResponseMessage .= "Email '$email' is not a valid valid email <br>";
}
// If phone number exists and is not valid
if (!InputValidate::hasOnlyNumbers($phoneNumber)) {
    $notValidResponseMessage .= "Phone number '$phoneNumber' does not have only numbers <br>";
}


// Print the notValid response message if it exists
if ($notValidResponseMessage) {
    SharedHtmlRendererM4::generateResponse($notValidResponseMessage, false);
    return; // Stop execution if any of the information is not valid
}

SharedHtmlRendererM4::generateResponse("User was successfully registered <br> Name is: $name <br> Email is: $email <br> Phone number is: $phoneNumber", true);


echo "<br><br>";
// Display added information
echo "The following information was registered: <br>";
echo $name . '<br>';
echo $email . '<br>';
echo $phoneNumber . '<br>';

// Saved in array


require '../sharedViewBottom.php';
