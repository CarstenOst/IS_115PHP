<?php


/**
 * Performs addition of two integers.
 * Takes two parameters of int and returns the sum of them
 *
 * @param int ...$numbers Accepts as many numbers wanted
 * @return int Returns the sum of inserted numbers as int
 */
function addition(int ...$numbers): int
{
    // If the array is empty return 0, else return the sum of the array.
    // Can be written more readable such as in the "average()" function call
    return empty($numbers) ? 0 : array_sum($numbers);
}


/**
 * Performs an average calculation of the numbers provided
 *
 * @param int ...$numbers Accepts as many numbers (int) as wanted (only memory limits)
 * @return float Returns 0 if there is no input
 */
function average(int ...$numbers): float
{
    // It's best practice to check if there is anything at all in the parameter to then return nothing (depending on use case)
    // So I definitely do not need nor want to later on divide on "0" (as int)
    if (empty($numbers)){
        return 0;
    }
    $sum = 0;
    $count = 0;

    // I'm using a foreach loop to only iterate over $numbers[] array once
    // Compared to use the count() and array_sum() function where I would have iterated twice over the array
    foreach ($numbers as $number){
        $sum += $number;
        $count++;
    }

    return $sum / $count;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['numbers'])) {
        $input = $_POST['numbers'];
        // I need to separate the numbers based on the commas provided by user.
        $numbers = array_map('intval', explode(',', $input));
        // Should serialize the input, so it's less chance of script kiddies (bad actors)

        // Here I run the functions created earlier
        $average = average(...$numbers);
        $sum = addition(...$numbers);
    } else {
        echo "No numbers entered.";
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Number Input</title>
</head>
<body>
    <!-- Normal form with a post method (to send data to the server) -->
    <form action="" method="POST">
        <label for="numbers">Enter numbers (separated by commas):</label><br>

        <!--Values typed into the super global variable $_POST is available to the php script
            The "??" accepts the left value ($_POST) if there is anything in it, else it inserts an empty string in the input field -->
        <input type="text" name="numbers" id="numbers" oninput="restrictInput(this)" value="<?php echo $_POST['numbers'] ?? ""; ?>" pattern="[0-9,]*" required>
        <!-- A warning that is displayed if the user enters anything other than numbers and commas
             Use of <br> to get some space. It's kinda ugly but it works
         -->
        <small id="warning" style="color: red; display: none;">Please enter numbers and commas only.</small><br><br>
        <input type="submit" value="Calculate Sum and Average">
    </form>

    <!-- Checks if the average variable is not empty, and if so, prints it out in an <p> element -->
    <?php if (!empty($average)) { ?>
        <p>Average: <?php echo $average; ?></p>
    <?php } ?>

    <!-- Checks if the sum variable is not empty, and if so, prints it out in an <p> element -->
    <?php if (!empty($sum)) { ?>
        <p>Sum: <?php echo $sum; ?></p>
    <?php } ?>

</body>
<script>
    // JavaScript that restricts input if it is anything else than a number or a comma (,)
    // I have used Regex to do this filtration, as it is very efficient and powerful
    // This is clientside though, so it can easily be turned off making serverside checks necessary
    // Serverside checks are "sort" of in place, as if you remove the restriction both here and on the first <input> tag you can enter characters
    // The code will ignore anything right of any character until it finds a comma. Example "12g3, 39" === "12, 39" (without the hermetegn '"')
    // Which brings me back to how the serverside won't crash
    function restrictInput(input) {
        const regex = /^[0-9,]*$/;
        const warning = document.getElementById('warning');
        warning.style.display = regex.test(input.value) ? 'none' : 'inline';
        input.value = input.value.replace(/[^0-9,]/g, '');
    }
</script>
</html>