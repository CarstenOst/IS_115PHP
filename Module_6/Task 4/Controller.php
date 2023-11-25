<?php
include '../sharedViewTop.php';
include '../SharedHtmlRendererM6.php';
include 'ValidateEmail.php';
// I could have used the constants, but whatever...
$email_cookie = 'email';

function processFormM6T4(array $value = []): void
{
    SharedHtmlRendererM6::renderFormArrayBased(['email'], ['email' => 'Enter your email'], $value);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Email will be set as the email entered if it is valid, else it will be false
    $email = ValidateEmail::now($_POST[$email_cookie]);

    // If email is not valid, display error message, and draw the form again
    if (!$email) {
        processFormM6T4();
        SharedHtmlRendererM6::generateResponse('Naughty naughty, your email is faulty!', false);
        return;
    }
    // If the code reaches here, it means that the email is valid, and we can generate a valid response.
    processFormM6T4([$email]);
    SharedHtmlRendererM6::generateResponse($email . ' is a valid email', true);

} else {
    processFormM6T4();
}


include '../sharedViewBottom.php';
