<?php
include 'TempConverter.php';
include '../ConstantsM5.php';
include '../sharedViewTop.php';
include '../SharedHtmlRendererM5.php';

/**
 * Renders the page.
 * @param array $value The values to put into the input fields.
 * @return void echos the page
 */
function renderPageM5T5(array $value = []): void
{
    SharedHtmlRendererM5::renderFormArrayBased(array_keys(INPUT_FIELDS_M5T5), INPUT_FIELDS_M5T5, $value);
}

/**
 * Processes the form.
 * This logic currently favors the first input field. If both are filled, the first one will be used.
 * Unless the first one does not contain a number, then the second one will be used.
 * @return void echos the page
 */
function processFormM5T5(): void
{
    // If the input is a number, convert it. Else just render the page with a message.
    // I also need to specify that 0 is considered a number in this setting,
    // because 0 is not caught by the if statement.
    if (floatval($_POST[CELSIUS]) || ($_POST[CELSIUS] == '0')) {
        renderPageM5T5([
            '',
            number_format(TempConverter::celsiusToFahrenheit(floatval($_POST[CELSIUS])),2) // 2 Decimals
        ]);
        return;
    }
    // Same as above, but for the Fahrenheit input field.
    if (floatval($_POST[FAHRENHEIT]) || $_POST[FAHRENHEIT] == '0') {
        renderPageM5T5([
            number_format(TempConverter::fahrenheitToCelsius(floatval($_POST[FAHRENHEIT])), 2),
            ''
        ]);
        return;
    }
    renderPageM5T5();
    echo 'Please enter a number';
}

// If submitted, process the form. Else just render the page.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    processFormM5T5();
} else {
    renderPageM5T5();
}

include '../sharedViewBottom.php';
