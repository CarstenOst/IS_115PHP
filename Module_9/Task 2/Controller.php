<?php
include '../sharedViewTop.php';


function logEvent($message, $logfile = 'log.txt'): void
{
    file_put_contents($logfile, date('Y-m-d H:i:s') . ' - ' . $message . "\n", FILE_APPEND);
}

function getLastTenEvents($logfile = 'log.txt'): void
{
    $lines = array_slice(file($logfile), -10);
    foreach ($lines as $line) {
        echo $line . "<br>";
    }
}

// example usage
logEvent("An request was made to the server.");
getLastTenEvents();

include '../sharedViewBottom.php';
