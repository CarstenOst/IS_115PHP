<?php
require '../PostHandler.php';
require '../SharedFormRenderer.php';
require '../sharedViewTop.php';
CONST COMMUNE_NAME = 'Commune_Name';

// Associative array with commune keys, and region as value
$communes = [
    'Kristiansand' => 'Vest-Agder',
    'Lillesand' => 'Vest-Agder',
    'Birkenes' => 'Aust-Agder',
    'Harstad' => 'Troms og Finnmark',
    'Kvæfjord' => 'Troms og Finnmark',
    'Tromsø' => 'Troms og Finnmark',
    'Bergen' => 'Vestland',
    'Trondheim' => 'Trøndelag',
    'Bodø' => 'Nordland',
    'Alta' => 'Troms og Finnmark'
];
// Print form
SharedFormRenderer::printForm(COMMUNE_NAME, 'Enter your Norwegian commune name');

// Get user input
$selectedCommune = PostHandler::secureRequestPost(COMMUNE_NAME); // Replace this with the desired commune

// If the selected commune is set
if ($selectedCommune) {
    // Check if the selected commune exists in the array
    $isAssocArray = $communes[$selectedCommune] ?? false;

    if ($isAssocArray){
        $message = $communes[$selectedCommune];
        echo "$selectedCommune exists in $message region.";
        return;
    }

    echo "Unknown commune: $selectedCommune";
}



















require '../sharedViewBottom.php';