<?php
include 'Validator.php';
include '../ConstantsM6.php';
include '../SharedHtmlRendererM6.php';

function renderPageM6(array $userInput = []): void
{
    require '../sharedViewTop.php';
    SharedHtmlRendererM6::renderFormArrayBased(
        array_keys(VALIDATION_INPUT_FIELDS),    // Get the keys from the input fields array
        VALIDATION_INPUT_FIELDS,           // Get the labels for the form
        $userInput                                // Get the user inputs
    );
}

function processForm(): void
{
    $notValidResponseMessage = [];
    $dataInput = $_POST;
    foreach ($dataInput as $key => $data) {
        if (Validator::isValid($key, $data)) {
            $dataInput[$key] = [$data, true];
            continue;
        }

        $dataInput[$key] = [$data, false];

        if ($key == PHONE)
            $key = 'number';
        $notValidResponseMessage[] = $data . ' is not a valid ' . strtolower($key);
    }

    // the content with some kind of response and display the form again.
    // We also stop the execution of the rest of this function, cause it already failed.
    if (!empty($notValidResponseMessage)) {
        SharedHtmlRendererM6::generateResponse($notValidResponseMessage, false);
        renderPageM6($dataInput);
        return;
    }

    // If we get here, we know that the data is valid, and we can create the success message.
    $validMessage = [
        "User was successfully registered:",
        "Email: {$dataInput[EMAIL][0]}",
        "Password: {$dataInput[PASSWORD][0]}",
        "Phone number: {$dataInput[PHONE][0]}"
    ];

    renderPageM6($dataInput); // Rerender the page with the data from the form. (so we get the success css triggered).
    SharedHtmlRendererM6::generateResponse($validMessage, true); // Generate the success message.

    echo "<br><br>"; // Space between the response and the success message.
    echo implode("<br>", $validMessage); // Echo the success message. To keep it visible for the user.
}


// If the request method is POST, we want to process the form, else we want to render the page with session data if any.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    processForm();
} else {
    renderPageM6();
}


include '../sharedViewBottom.php';
