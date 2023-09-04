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

if (!$name && !$email && !$phoneNumber) {
    return;
}

$notValidResponseMessage = '';

// If name exists and is not valid
if ($name && !InputValidate::hasNoSpecialCharacters($name)) {
    $notValidResponseMessage .= "'$name' must have letters, and no numbers or special characters <br>";
}
// If email exists and is not valid
if ($email && !InputValidate::isEmail($email)) {
    $notValidResponseMessage .= "'$email' is not a valid valid email <br>";
}
// If phone number exists and is not valid
if ($phoneNumber && !InputValidate::hasOnlyNumbers("123")) {
    $notValidResponseMessage .= "'$phoneNumber' does not have only numbers <br>";
}


// Print the notValid response message if it exists
if ($notValidResponseMessage) {
    SharedHtmlRendererM4::generateResponse($notValidResponseMessage, false);
    return; // Stop execution if any of the information is not valid
}


SharedHtmlRendererM4::generateResponse("User was successfully registered <br> Name is: $name <br> Email is: $email <br> Phone number is: $phoneNumber", true);


$to = $_POST[EMAIL_COOKIE];
$subject = "Email Subject";

$message = 'Dear blyat,<br>';
$message .= "We welcome you to be part of family<br><br>";
$message .= "Regards,<br>";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <politiet@uia.no>' . "\r\n";
$headers .= 'Cc: slappkuk123@gmail.com' . "\r\n";

mail($to,$subject,$message,$headers);

echo "sendt mail to $to, with subject $subject, and message $message, and headers $headers";

echo "<br><br>";
// Generate Response
echo $name . '<br>';
echo $email . '<br>';
echo $phoneNumber . '<br>';

// Saved in array


require '../sharedViewBottom.php';
