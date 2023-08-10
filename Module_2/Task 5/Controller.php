<?php
require 'PasswordGenerator.php';
require_once '../sharedViewTop.php';



echo <<<HTML
    <form method="post">
        <button type="submit" name="refresh">New password</button>
    </form>
    <br>
HTML;

$password = PasswordGenerator::getValidPassword();


echo 'Your randomly generated password is: ';
// Without htmlspecialchars(), the password will sometimes not be displayed correctly
echo htmlspecialchars($password);


if (isset($_POST['generate password'])) {
    // Refresh the page
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}


require_once '../sharedViewBottom.php';