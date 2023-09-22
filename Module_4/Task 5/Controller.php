<?php
include '../Constants.php';
include '../SharedHtmlRendererM4.php';
require '../sharedViewTop.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $formData = [
        'name' => sanitizeInput($_POST[NAME_COOKIE]),
        'email' => sanitizeInput($_POST[EMAIL_COOKIE]),
        'subject' => sanitizeInput($_POST[SUBJECT]),
        'message' => sanitizeInput($_POST[MESSAGE])
    ];

    SharedHtmlRendererM4::renderFormArrayBased(
        array_keys(INPUT_FIELDS_TASK_5),
        INPUT_FIELDS_TASK_5,
        array_values($formData)
    );

    displayMessage($formData);

} else {
    SharedHtmlRendererM4::renderFormArrayBased(
        array_keys(INPUT_FIELDS_TASK_5),
        INPUT_FIELDS_TASK_5
    );
}

function sanitizeInput($data): string
{
    return htmlspecialchars(trim($data));
}

function displayMessage($formData) {
    echo "<h2>Your Message:</h2>";
    echo "<strong>Name:</strong> " . $formData['name'] . "<br>";
    echo "<strong>Email:</strong> " . $formData['email'] . "<br>";
    echo "<strong>Subject:</strong> " . $formData['subject'] . "<br>";
    echo "<strong>Message:</strong><br>" . nl2br($formData['message']);
}


require '../sharedViewBottom.php';
