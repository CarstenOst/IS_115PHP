<?php
require '../PostHandler.php';
require '../SharedFormRenderer.php';

CONST BALANCE_COOKIE = 'Balance';
CONST INTEREST_COOKIE = 'Interest';





require '../sharedViewTop.php';

// Start balance
$S0 = 0;
SharedFormRenderer::printTwoInputForms(BALANCE_COOKIE, 'Enter your balance', INTEREST_COOKIE, 'Enter your interest');
// interest






















require '../sharedViewBottom.php';