<?php
include 'LastNameFormatting.php';
include 'HtmlRenderer.php';
// If the submit button is pressed, this code will run
$data = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['string'])) {
        $input = $_POST['string'];

        $formattedLastName = LastNameFormatting::capitalizeLastNameAndCount($input);

        setcookie(LastNameFormatting::FORMATTED_NAME, json_encode($formattedLastName), time() + 3600, "/");
        header('Location: Controller.php');
        exit();
    } else {
        echo "Please enter your last name";
    }
}
// I'm trying different ways of combining a standard html layout
// I still think this is trash, as my code is not bundled inside the specific div I want of the .php included here
// As I have to use JS to access this, it can be complicated for anyone that did not write this code
include '../sharedView.php';

HtmlRenderer::lastNameFormPrint();
HtmlRenderer::lastNameInfoPrint();