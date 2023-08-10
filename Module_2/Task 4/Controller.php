<?php
require_once 'Calculator.php';
require '../sharedViewTop.php';


echo <<<FORM
    <form action="" method="post">
        <label for="num1">Number 1:</label>
        <input type="number" name="num1" id="num1" required>
    
        <label for="num2">Number 2:</label>
        <input type="number" name="num2" id="num2" required>
    
        <input type="submit" name="submit" value="Calculate the difference">
    </form>
FORM;

// If the button is pressed, this code will run
if (isset($_POST['submit'])) {
    // Getting input from the user, by using PHP's super global $_POST
    $num1 = $_POST['num1'];
    $num2 = $_POST['num2'];
    // Just some space from the navigation bar
    echo "<br>";
    // Calling abs() on the result of Calculator::calculate() to make sure the result is positive
    // Printing the result as a sentence
    echo "The differance of $num1 and $num2 is " . abs(Calculator::calculate($num1, '-', $num2));
}

// It works without this line, but it's good practice to close the HTML document
require '../sharedViewBottom.php';