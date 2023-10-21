<?php
include 'Encryption.php';
include '../ConstantsM5.php';
include '../sharedViewTop.php';
include '../SharedHtmlRendererM5.php';
function renderPageM5(array $value = []): void
{
    SharedHtmlRendererM5::renderFormArrayBased(array_keys(INPUT_FIELDS_M5T4), INPUT_FIELDS_M5T4, $value);
}

function processFormM5(): void
{
    if (!empty($_POST[ENCRYPTING])) {
        renderPageM5([
            '',
            Encryption::carstenCipher($_POST[ENCRYPTING], 3)
        ]);
        return;
    } elseif (!empty($_POST[DECRYPTING])) {
        renderPageM5([
            Encryption::carstenCipher($_POST[DECRYPTING], -3),
            ''
        ]);
        return;
    }
    renderPageM5();
    echo 'Try writing into the input fields';
}

// If submitted, process the form. Else just render the page.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    processFormM5();
} else {
    renderPageM5();
}


include '../sharedViewBottom.php';
