<?php
require '../PostHandler.php';
require '../sharedViewTop.php';


//echo "Square 1 <br>";
//echo $totalGrains . "<br>";
//echo "Square ". $i+1;
//echo '<br>';
//echo $totalGrains;
//echo '<br>';

// Could be made const, but whatever
$grainsOnFirstSquare = 1; // Start with 1 grain on the first square
$grainWeightGrams = 0.035; // Weight of a grain in grams (wikipedia says 0.065g)

$chessboardSize = 64; // Total number of squares on a chessboard

$grainsOnEachSquare = [$grainsOnFirstSquare];
$totalGrains = $grainsOnFirstSquare;


// Calculate the number of grains on each square and the total grains
//for ($i = 1; $i < $chessboardSize; $i++) {
//    $grainsOnEachSquare[] = $grainsOnEachSquare[$i - 1] * 2;
//    $totalGrains += $grainsOnEachSquare[$i];
//}

for ($i = 1; $i < $chessboardSize; $i++) {
    $grainsOnCurrentSquare = 2 ** $i;
    $grainsOnEachSquare[] = $grainsOnCurrentSquare;
    $totalGrains += $grainsOnCurrentSquare;
}


// Display results
for ($i = 0; $i < count($grainsOnEachSquare); $i++) {
    echo "Square number:  " . ($i+1) ."<br>";
    echo "Number of grains: " . getFormattedNumber($grainsOnEachSquare[$i]) . "<br>";
    echo "Weight in metric tonnes: " . getWeightInTons($grainsOnEachSquare[$i], $grainWeightGrams) . "<br> <br>";
}
echo "Total number of grains: " . getFormattedNumber($totalGrains) . "<br>";
echo "Total weight in metric tonnes: " . getWeightInTons($totalGrains, $grainWeightGrams) . "<br> <br>";


function getWeightInTons($grains, $grainWeightGrams): string
{
    $weightInGrams = $grains * $grainWeightGrams;
    $weightInKilograms = $weightInGrams / 1000; // Convert grams to kilograms
    $weightInTons = $weightInKilograms / 1000; // Convert kilograms to tons

    return getFormattedNumber($weightInTons);
}


function getFormattedNumber($number): string
{
    if ($number < 1) {
        return number_format($number, 9);
    }
    return number_format($number, 0);
}


require '../sharedViewBottom.php';