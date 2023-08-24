<?php
require '../PostHandler.php';
require '../SharedFormRenderer.php';

CONST BALANCE_COOKIE = 'Balance';
CONST INTEREST_COOKIE = 'Interest';


require '../sharedViewTop.php';

SharedFormRenderer::printTwoInputForms(BALANCE_COOKIE, 'Enter your balance', INTEREST_COOKIE, 'Enter your interest');

$balance = floatval(PostHandler::secureRequestPost(BALANCE_COOKIE));
$interest = floatval(PostHandler::secureRequestPost(INTEREST_COOKIE));



if ($balance and $interest) {
    if ($interest < 1) {
        $interest += 1;
    }

    echo "Balance is $balance <br>";
    echo "The interest is set to; $interest <br>";

    for ($i = 1; $i < 10; $i++) {
        $balance *= $interest;
        echo "Balance after $i year is; $balance <br>";
    }
} else {
    echo 'Enter int or float values only';
}
























require '../sharedViewBottom.php';