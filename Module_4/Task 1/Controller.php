<?php
include '../sharedViewTop.php'; // Draw the navbar
include 'AssocArray.php'; // Include the class for this task (1)



// Create an associative array with the following keys (value will be 1, as the task did not specify a value).
// I'm using reference to simulate pointer-like behaviour. This will also be more efficient as we don't need to copy the array.
AssocArray::create($assocArr,0, 3, 5, 7, 8, 15);


AssocArray::print($assocArr); // Print the array with the following function:


echo '<br> Running print_r() <br>';
print_r($assocArr); // Print the array with keys and values by using print_r();



require '../sharedViewBottom.php'; // Finish the html page (not actually needed).