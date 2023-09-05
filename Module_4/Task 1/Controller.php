<?php
// Draw the navbar
require '../sharedViewTop.php';
// Include the class for this task (1)
include 'AssocArray.php';




// Create an associative array with the following keys (value will be 1, as the task did not specify a value);
AssocArray::create($assocArr,0, 3, 5, 7, 8, 15);

// You can uncomment the following line to see the array become modified
// I've called the function 'modify' because if the key is set to the same as is in $assocArr, then it will overwrite or modify
//AssocArray::modify($assocArr,13,452, 545, 5, 242, 125);

// Print the array with the following function:
AssocArray::print($assocArr);


echo '<br> Running print_r() <br>';
// Print the array with keys and values by using print_r();
print_r($assocArr);



// Finish the html page (not actually needed)
require '../sharedViewBottom.php';
