<?php
require '../PostHandler.php';



// Chess


require '../sharedViewTop.php';




$grainsOnFirstSquare = 1; // Start with 1 grain on the first square
$grainWeightGrams = 0.035; // Weight of a grain in grams

$chessboardSize = 64; // Total number of squares on a chessboard

$grainsOnEachSquare = [$grainsOnFirstSquare];
$totalGrains = $grainsOnFirstSquare;

// Calculate the number of grains on each square and the total grains
for ($i = 1; $i < $chessboardSize; $i++) {
    $grainsOnEachSquare[] = $grainsOnEachSquare[$i - 1] * 2;
    $totalGrains += $grainsOnEachSquare[$i];
}

$weightInGrams = $totalGrains * $grainWeightGrams;
$weightInKilograms = $weightInGrams / 1000; // Convert grams to kilograms
$weightInTons = $weightInKilograms / 1000; // Convert kilograms to tons

// Display results
echo "Rute\tAntall hvetekorn\tVekt (tonn)<br>";
for ($i = 0; $i < $chessboardSize; $i++) {
    echo ($i + 1) . "\t" . $grainsOnEachSquare[$i] . "\t" . number_format($weightInTons, 4) . "<br>";
}



















require '../sharedViewBottom.php';