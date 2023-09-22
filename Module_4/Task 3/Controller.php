<?php
include 'ChangeHandler.php';
include '../Constants.php';
include '../SharedHtmlRendererM4.php';
// Reuse code from task 2.
include '../Task 2/InputHandler.php';
include '../Task 2/InputValidation.php';

// This code is very similar to task 2. I moved the new logic used to 'ChangeHandler.php'
// Now normally session_start() is called before includes, as if they echo anything the code will possibly halt
// However, I wrote those codes, so I know they won't do that.
session_start();

// Hardcode a global user in an associative array
$user = [
    NAME_COOKIE => ['Kurt Nilsen', true],
    EMAIL_COOKIE => ['kurt@nilsen.com', true],
    NUMBER_COOKIE => ['47283748', true]
];

function renderPageT3($userInput = []): void
{
    include_once '../sharedViewTop.php';
    SharedHtmlRendererM4::renderFormArrayBased(
        array_keys(INPUT_FIELDS),
        INPUT_FIELDS,
        $userInput,
    );
    echo <<<HTML
            <form method="post" action="">
                <button type="submit" name="deleteSession">Kurt Nilsen</button>
            </form>
        HTML;
}
function processFormT3($userInput): void
{
    // We want to use the global user.
    global $user;
    // If session is empty, we set the oldInput as the hardcoded user (as specified in the task).
    // Else we use the previous sent user stored in session.
    // If the form in task 2 is being used, then session is already set.
    // (Just for fun, and not to recommend unless needed ofc.).
    if (empty($_SESSION)) {
        $_SESSION = $user;
    }
    $oldInput = $_SESSION;

    // Instantiate the InputHandler class
    $handler = new InputHandler();

    // Dynamically configure input processing rules.
    $handler->addConfig(NAME_COOKIE, [InputValidate::class, 'validateName']);
    $handler->addConfig(EMAIL_COOKIE, [InputValidate::class, 'validateEmail'], [InputValidate::class, 'removeWhiteSpace']);
    $handler->addConfig(NUMBER_COOKIE, [InputValidate::class, 'validatePhoneNumber'], [InputValidate::class, 'removeWhiteSpace']);


    // Process inputs based on configured rules.
    list($dataInput, $notValidResponseMessage) = $handler->processInputs($userInput);

    // To see if anything was changed or not
    $changes = ChangeHandler::detectChanges($dataInput, $oldInput);

    // If errors or not valid response message is not empty, we want to display the errors and the form again.
    if (!empty($notValidResponseMessage)) {
        SharedHtmlRendererM4::generateResponse($notValidResponseMessage, false);
        renderPageT3($dataInput);
        // Echo if any changes has been made.
        echo ChangeHandler::changeMsg($changes);
        return;
    }
    // The task asked for array, and array is given
    $validMessage = [
        "User was successfully registered:",
        "Name: {$dataInput[NAME_COOKIE][0]}",
        "Email: {$dataInput[EMAIL_COOKIE][0]}",
        "Number: {$dataInput[NUMBER_COOKIE][0]}"
    ];

    // Render the page with our new dataInput
    renderPageT3($dataInput);

    // Echo if there has been any changes or not
    echo ChangeHandler::changeMsg($changes);

    // Generate a popup response. This will always be true,
    // as we return before this code if there are errors in the input.
    SharedHtmlRendererM4::generateResponse($validMessage, true);

    echo "<br><br>";
    echo implode("<br>", $validMessage);
}


// Check if submit is pressed, and process the form if it is. Else check if session is set,
// and render the page with the session. Lastly if either is true, just render the page with the hardcoded user.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // If reset is pressed, then destroy the session and insert the standard hard coded user "Kurt Nilsen"
    if (isset($_POST['deleteSession'])) {
        session_unset();     // Clear the session data
        session_destroy();   // Destroy the session

        renderPageT3($user); // Render the page with hard coded user
        return;
    }
    processFormT3($_POST); // If reset is not pressed, then process the form with the input from the user
} else if (isset($_SESSION)) {
    renderPageT3([
        NAME_COOKIE => $_SESSION[NAME_COOKIE] ?? '',
        EMAIL_COOKIE => $_SESSION[EMAIL_COOKIE] ?? '',
        NUMBER_COOKIE => $_SESSION[NUMBER_COOKIE] ?? ''
    ]);
    return;
} else {
    renderPageT3($user);
}


require '../sharedViewBottom.php';
