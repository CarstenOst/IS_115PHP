<?php
require("../autoloader.php");
use Validators\Auth;

Auth::logout();
header('Location: ../Views/Login.php?response[]=You have successfully been logged out!&response[]=1');