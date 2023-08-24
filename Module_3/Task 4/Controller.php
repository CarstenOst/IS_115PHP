<?php
require '../PostHandler.php';
require '../SharedFormRenderer.php';

CONST COMMUNE_NAME = 'Commune_Name';

// Check region


require '../sharedViewTop.php';

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

SharedFormRenderer::printForm(COMMUNE_NAME, 'Enter your Norwegian commune name');

$selectedCommune = PostHandler::secureRequestPost(COMMUNE_NAME); // Replace this with the desired commune


if ($selectedCommune) {
    $message = $communes[$selectedCommune] ?? "Ukjent kommune: $selectedCommune";
    echo "$selectedCommune ligger i $message fylke.";
}



















require '../sharedViewBottom.php';