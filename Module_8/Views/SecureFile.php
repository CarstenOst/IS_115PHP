<?php


use Validators\Auth;
use Validators\SessionConst;

require("../autoloader.php");

if (Auth::isLoggedIn()) {
    echo '<h1>This page is secure, and only for logged-in users</h1>';
    echo '<br>';
    echo 'Your name is: ' . $_SESSION[SessionConst::FIRST_NAME] . ' ' . $_SESSION[SessionConst::LAST_NAME];
} else {
    header("Location: ./Login.php?response[]=You are not logged in!&response[]=0");
}
