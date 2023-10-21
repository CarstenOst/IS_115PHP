<?php
include 'TempConverter.php';
include '../ConstantsM5.php';
include '../sharedViewTop.php';
include '../SharedHtmlRendererM5.php';
function renderPageM5T5(array $value = []): void
{
    SharedHtmlRendererM5::renderFormArrayBased(array_keys(INPUT_FIELDS_M5T5), INPUT_FIELDS_M5T5, $value);
}

function processFormM5T5(): void
{
    if (floatval($_POST[CELSIUS]) || ($_POST[CELSIUS] == '0')) {
        renderPageM5T5([
            '',
            number_format(TempConverter::celsiusToFahrenheit(floatval($_POST[CELSIUS])),2)
        ]);
        return;
    } elseif (floatval($_POST[FAHRENHEIT]) || $_POST[FAHRENHEIT] == '0') {
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
