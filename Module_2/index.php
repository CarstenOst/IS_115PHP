<?php
// I assume you want to start checking out the task in order. So I will redirect index to
// the task 1 controller
if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) {
    header('Location: Task_1_Lastname/Controller.php');
    exit;
}