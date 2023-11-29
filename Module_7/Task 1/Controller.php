<?php
include '../sharedViewTop.php';
include '../autoloader.php';

use Database\DBConnector;

$PDO = DBConnector::getConnection();

print_r($PDO);


include '../sharedViewBottom.php';
