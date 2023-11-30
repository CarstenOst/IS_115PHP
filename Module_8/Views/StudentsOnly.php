<?php

use Enums\UserTypes;
use Validators\Auth;
use Validators\SessionConst;

require("../autoloader.php");

if (Auth::isRole(UserTypes::Student)) {
    echo '<h1>You are a student. Welcome to the student page</h1>';
    echo '<br>';
    echo 'Your name is: ' . $_SESSION[SessionConst::FIRST_NAME] . ' ' . $_SESSION[SessionConst::LAST_NAME];
} else {
    header("Location: ./Login.php?response[]=You are not a student!&response[]=0");
}