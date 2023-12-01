<?php


include '../ConstantsM10.php';
include '../SharedHtmlRendererM10.php';
include '../sharedViewTop.php';


/**
 * Very basic "sanitizing" of input. Do not send to a database after this!
 *
 * @param $data - the data to sanitize.
 * @return string returns the "sanitized" data.
 */
function sanitizeInput($data): string
{
    return htmlspecialchars(strip_tags(trim($data)));
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
    echo "<strong>Name:</strong> " . $formData[NAME] . "<br>";
    echo "<strong>Email:</strong> " . $formData[EMAIL_RECIPIENT] . "<br>";
    echo "<strong>Subject:</strong> " . $formData[SUBJECT] . "<br>";
    echo "<strong>Message:</strong><br>" . nl2br($formData[MESSAGE]);
    echo '<br>';
}

function sendMail(array $formData): void
{
    // Make sure the email is a valid email
    $email = filter_var($formData[EMAIL_RECIPIENT], FILTER_SANITIZE_EMAIL);
    $subject = $formData[SUBJECT];
    $message = $formData[MESSAGE];

    // If any of the inputs are empty, we output an error message.
    if (empty($email) || empty($subject) || empty($message)) {
        echo "Please fill in all fields.";
    } else {
        $headers = [
            "Content-Type: application/json",
            "Authorization: Bearer re_5cE4VGtu_BqoJshHEYe8ThdMb1u4t9FFR", // This Bearer is revoked :)
        ];


        $data = [
            "from" => "onboarding@resend.dev",
            "to" => $email,
            "subject" => $subject,
            "html" => $message . "<br> Best wishes, <br>{$formData[NAME]}",
        ];

        // Create context options with headers for the API request
        $api_options = [
            "http" => [
                "method" => "POST",
                "header" => implode("\r\n", $headers),
                "content" => json_encode($data),
            ],
        ];

        // Create a stream context for the API request
        $api_context = stream_context_create($api_options);

        // Send the API POST request and get the response
        $api_response = file_get_contents("https://api.resend.com/emails", false, $api_context);

        if ($api_response === false) {
            echo "Email failed to send";
        } else {
            echo "Email sent successfully!";
        }
    }
}


// If the user submits the form, we first sanitize the input, and then store it in an associative array
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $formData = [
        NAME => sanitizeInput($_POST[NAME]),
        EMAIL_RECIPIENT => sanitizeInput($_POST[EMAIL_RECIPIENT]),
        SUBJECT => sanitizeInput($_POST[SUBJECT]),
        MESSAGE => sanitizeInput($_POST[MESSAGE])
    ];

    // Render the form by using the formData
    SharedHtmlRendererM10::renderFormArrayBased(
        array_keys(INPUT_FIELDS_TASK_1),
        INPUT_FIELDS_TASK_1,
        array_values($formData)
    );

    displayMessage($formData);  // Display the message with the required information
    sendMail($formData);

} else {
    // If there is no submit, this means the page is (re)loaded. We then know there is no input, and
    // can therefore render the form without any user input.
    SharedHtmlRendererM10::renderFormArrayBased(
        array_keys(INPUT_FIELDS_TASK_1),
        INPUT_FIELDS_TASK_1
    );
}

require '../sharedViewBottom.php';
