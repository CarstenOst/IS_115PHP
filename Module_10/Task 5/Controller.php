<?php
include '../Constants.php';
include '../SharedHtmlRendererM10.php';
require '../sharedViewTop.php';


// If the user submits the form, we first sanitize the input, and then store it in an associative array
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $formData = [
        NAME_COOKIE => sanitizeInput($_POST[NAME_COOKIE]),
        EMAIL_COOKIE => sanitizeInput($_POST[EMAIL_COOKIE]),
        SUBJECT => sanitizeInput($_POST[SUBJECT]),
        MESSAGE => sanitizeInput($_POST[MESSAGE])
    ];

    // Render the form by using the formData
    SharedHtmlRendererM4::renderFormArrayBased(
        array_keys(INPUT_FIELDS_TASK_5),
        INPUT_FIELDS_TASK_5,
        array_values($formData)
    );

    displayMessage($formData);  // Display the message with the required information

} else {
    // If there is no submit, this means the page is (re)loaded. We then know there is no input, and
    // can therefore render the form without any user input.
    SharedHtmlRendererM4::renderFormArrayBased(
        array_keys(INPUT_FIELDS_TASK_5),
        INPUT_FIELDS_TASK_5
    );
}


/**
 * Very basic "sanitizing" of input. Do not send to a database after this!
 *
 * @param $data - the data to sanitize.
 * @return string returns the "sanitized" data.
 */
function sanitizeInput($data): string
{
    return htmlspecialchars(trim($data));
}


/**
 * Basic display of an array with keys from Constants.php.
 * KEYS USED: NAME_COOKIE, EMAIL_COOKIE, SUBJECT, MESSAGE.
 *
 * @param array $formData - Must be arrayed with keys: NAME_COOKIE, EMAIL_COOKIE, SUBJECT, MESSAGE.
 * @return void
 */
function displayMessage(array $formData): void
{
    echo "<h2>Your Message:</h2>";
    echo "<strong>Name:</strong> " . $formData[NAME_COOKIE] . "<br>";
    echo "<strong>Email:</strong> " . $formData[EMAIL_COOKIE] . "<br>";
    echo "<strong>Subject:</strong> " . $formData[SUBJECT] . "<br>";
    echo "<strong>Message:</strong><br>" . nl2br($formData[MESSAGE]);
}


require '../sharedViewBottom.php';
