<?php
// I assume you want to start checking out the task in order. So I will redirect index to
// the task 1 controller
// This is also a way to prevent direct access to this file from browser
// Where __FILE__ is a magic constant that returns the full path and filename of the file it is used in
// While $_SERVER['SCRIPT_FILENAME'] returns the full path and file name of the script that is currently executed
// So if they are the same, the statement is true
if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) {
    header('Location: Task 1/Controller.php');
    exit;
}