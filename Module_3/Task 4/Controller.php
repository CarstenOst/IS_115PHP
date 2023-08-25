<?php
require '../PostHandler.php';
require '../SharedFormRenderer.php';
require '../sharedViewTop.php';
CONST COMMUNE_NAME = 'Commune_Name';

// Print form
SharedFormRenderer::printForm(COMMUNE_NAME, 'Enter your Norwegian commune name');

// Get user input
$selectedCommune = PostHandler::secureRequestPost(COMMUNE_NAME); // Replace this with the desired commune

match ($selectedCommune){
    'Kristiansand', 'Lillesand', 'Birkenes' => $region = 'Vest-Agder',
    'Harstad', 'Kvæfjord', 'Tromsø', 'Alta' => $region = 'Troms og Finnmark',
    'Bergen' => $region = 'Vestland',
    'Trondheim' => $region = 'Trøndelag',
    'Bodø' => $region = 'Nordland',
    default => $region = false,
};

if ($region){
    echo "$selectedCommune exists in $region region.";
} else if ($selectedCommune) {
    echo "Unknown commune: $selectedCommune";
}




















require '../sharedViewBottom.php';