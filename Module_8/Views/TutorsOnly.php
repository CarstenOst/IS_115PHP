<?php

use Enums\UserTypes;
use Validators\Auth;
use Validators\SessionConst;

require("../autoloader.php");

if (Auth::isRole(UserTypes::Tutor)) {
    echo '<h1>You are a tutor. Welcome to the tutor page</h1>';
    echo '<br>';
    echo 'Your name is: ' . $_SESSION[SessionConst::FIRST_NAME] . ' ' . $_SESSION[SessionConst::LAST_NAME];
} else {
    header("Location: ./Login.php?response[]=You are not a tutor!&response[]=0");
}