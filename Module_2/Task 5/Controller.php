<?php
require 'PasswordGenerator.php';
require_once '../sharedViewTop.php';


// Display the new password button
echo <<<HTML
    <form method="post">
        <button type="submit" name="refresh">New password</button>
    </form>
    <br>
HTML;

// Get a valid password
$password = PasswordGenerator::getValidPassword();

// Display the password.
// Without the htmlspecialchars() function, the password will sometimes not be displayed correctly.
echo 'Your randomly generated password is: ' . htmlspecialchars($password);

// If the button from the displayed button is pressed, refresh the page
if (isset($_POST['generate password'])) {
    // Refresh the page
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

// It works without this line, but it's good practice to close the HTML document
require_once '../sharedViewBottom.php';