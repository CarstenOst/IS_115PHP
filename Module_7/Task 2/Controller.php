<?php


include 'InputHandler2.php';
require_once("../autoloader.php");

use Models\User;
use Repositories\ErrorCode;
use Validators\Auth;
use Validators\Validator;
use Repositories\UserRepository;

class Controller
{
    public const FIRST_NAME = 'firstName';
    public const LAST_NAME = 'lastName';
    public const EMAIL = 'email';
    public const PASSWORD = 'password';
    public const USER_TYPE = 'userType';

    public const FORM_FIELDS = [
        self::FIRST_NAME => "First Name",
        self::LAST_NAME => "Second Name",
        self::EMAIL => "Email",
        self::PASSWORD => "Password",
        self::USER_TYPE => "User Type"
    ];

    /**
     * Registers a user using the form field values
     * @param array $formData the form fields and values as an associated matrix
     * @return int the id of the inserted user
     * @throws Exception
     */
    public static function registerUser(array $formData, &$notValidResponseMessage): int
    {
        // Creates the user, and sends this to the database
        $user = new User();
        $user->setFirstName(self::formatName($formData[self::FIRST_NAME][0]));
        $user->setLastName(self::formatName($formData[self::LAST_NAME][0]));
        $user->setEmail($formData[self::EMAIL][0]);
        $user->setPassword(password_hash($formData[self::PASSWORD][0], PASSWORD_BCRYPT));
        $user->setUserType($formData[self::USER_TYPE][0]);
        $user->setAbout("");
        $user->setCreatedAt(new \DateTime());
        $user->setUpdatedAt(new \DateTime());

        try {
            $createdUserId = UserRepository::create($user);
        } catch (Exception $e) {
            // If the email already exists, we want to return a negative number
            // to indicate that the user was not created.
            if ($e->getCode() == -ErrorCode::DUPLICATE_EMAIL) {
                $notValidResponseMessage[] = "Your email already exists. Try to login or use another email";
                return ErrorCode::DUPLICATE_EMAIL;
            }
            $notValidResponseMessage[] = "Something went wrong. Please try again later";
            throw $e;
        }

        // This chains the database queries, which might not be the best
        // TODO less coupling
        Auth::authenticate($formData[self::PASSWORD][0], $formData[self::EMAIL][0]);
        // Returns the status of the sql updating the user
        return $createdUserId;
    }

    /**
     * Function for formatting a name so each word's first letter is capitalized
     * @param string $name a string name to format so each word's first letter capitalized
     *
     * @return string of the name formatted with each word's first letter capitalized
     */
    public static function formatName(string $name): string
    {
        return mb_convert_case(
            mb_strtolower($name), MB_CASE_TITLE, "UTF-8"
        );
    }

    /**
     * Renders the page with the form
     *
     * @param array $userInput - optional, if not given, will render the form with empty inputs
     * @return void - echos the html code
     */
    public static function renderPage(array $userInput = []): void
    {
        include '../sharedViewTop.php';
        echo "<h2>Register</h2>";
        SharedHtmlRendererM7::renderFormArrayBased(
            array_keys(self::FORM_FIELDS),  // Get the keys from the input fields array
            self::FORM_FIELDS,          // Get the labels for the form
            $userInput                           // Get the user inputs
        );
        echo "<p><small>Already a user?</small></p>
        <a href='./Login.php'>Login</a>";
    }

    private static function notValidResponse(array $notValidResponseMessage, $dataInput): void
    {
        SharedHtmlRendererM7::generateResponse($notValidResponseMessage, false,
            count($notValidResponseMessage) * 1500 + 1000); // Time until death! (of msg)
        self::renderPage($dataInput);
    }

    /**
     * Processes the form with validation and such
     *
     * @return void - echos the html code (by using renderPage() and the generateResponse()).
     * @throws Exception
     */
    public static function processForm(): void
    {
        $handler = new InputHandler2(); // Instantiate the InputHandler class

        // Dynamically configure input processing rules.
        // This so I can reuse the InputHandler, rather than hard coding it here.
        // Also, im going to use this code for the project, so I want to make it as reusable as possible.
        $handler->addConfig(self::FIRST_NAME, [Validator::class, 'validateName']);
        $handler->addConfig(self::LAST_NAME, [Validator::class, 'validateName']);
        $handler->addConfig(self::EMAIL, [Validator::class, 'validateEmail'], [Validator::class, 'removeWhiteSpace']);
        $handler->addConfig(self::PASSWORD, [Validator::class, 'validatePassword']);
        $handler->addConfig(self::USER_TYPE, [Validator::class, 'validateUserType']);

        //TODO ADD LENGTH RESTRICTION OF 255!

        // Process inputs based on configured rules, and store them as dataInput and notValidResponseMessage
        list($dataInput, $notValidResponseMessage) = $handler->processInputs($_POST);

        // If validResponseMessage is not empty, we want to display
        // the content with some kind of response and display the form again.
        // We also stop the execution of the rest of this function, cause it already failed.
        if (!empty($notValidResponseMessage)) {
            self::notValidResponse($notValidResponseMessage, $dataInput);
            return;
        }


        $lastInsertedId = Controller::registerUser($dataInput, $notValidResponseMessage);
        // if register user returns a negative number, it means an error code was triggered,
        // such as duplicate email for example.
        if (!empty($notValidResponseMessage)) {
            self::notValidResponse($notValidResponseMessage, $dataInput);
            return;
        }

        // If we get here, we know that the data is valid, and in the database, so we can create a success message.
        $validMessage = [ // The task asked for array, and array is given
            "User was successfully registered:",
            "First name: {$dataInput[self::FIRST_NAME][0]}",
            "Last name: {$dataInput[self::LAST_NAME][0]}",
            "Email: {$dataInput[self::EMAIL][0]}",
            "Password: {$dataInput[self::PASSWORD][0]}", // This stupid, TODO REMOVE!
            "User type: {$dataInput[self::USER_TYPE][0]}"
        ];

        self::renderPage($dataInput); // Rerender the page with the data from the form. (so we get the success css triggered).
        SharedHtmlRendererM7::generateResponse($validMessage, true); // Generate the success message.

        echo "<br><br>"; // Space between the response and the success message.
        echo implode("<br>", $validMessage); // Echo the success message. To keep it visible for the user.
    }
}

// If the request method is POST, we want to process the form, else we want to render the page with session data if any.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    Controller::processForm();
} else {
    Controller::renderPage();
}

