<?php
require_once 'Validate.php';
require_once '../PostHandler.php';
require_once '../CookieHandler.php';
require_once 'ValidateEmailView.php';
require_once '../Task 1/HtmlRenderer.php';

// Get the input from user
$email = PostHandler::requestPost(Validate::COOKIE_NAME);

// If no input and there is a cookie, display the cookie
if (!$email and CookieHandler::isCookie(Validate::COOKIE_NAME)) {
    $email = CookieHandler::getCookie(Validate::COOKIE_NAME);
    ValidateEmailView::generateView(Validate::COOKIE_NAME, $email);
    return;
}

// If there is an input
if ($email) {
    // If the email is valid, set the cookie
    if (Validate::email($email)) {
        CookieHandler::set(Validate::COOKIE_NAME, $email);
        ValidateEmailView::generateView(Validate::COOKIE_NAME, $email);
        HtmlRenderer::generateResponse('Valid e-mail added: ' . $email, true);
        return;
    }
    // If the email is not valid, remove the previous cookie
    if (CookieHandler::isCookie(Validate::COOKIE_NAME)){
        CookieHandler::removeCookie(Validate::COOKIE_NAME);
    }
    // If the input is invalid, draw the page and display form with error message
    require '../sharedViewTop.php';
    ValidateEmailView::displayForm(Validate::COOKIE_NAME, $email);
    HtmlRenderer::generateResponse($email . ' is not a valid e-mail', false);
    require '../sharedViewBottom.php';
    return;
}

// Lastly, if there is no input nor cookie, draw the page with empty form
ValidateEmailView::generateView(Validate::COOKIE_NAME, '');