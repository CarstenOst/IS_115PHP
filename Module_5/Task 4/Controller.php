<?php
include 'Encryption.php';
include '../ConstantsM5.php';
include '../sharedViewTop.php';
include '../SharedHtmlRendererM5.php';

/**
 * Renders the page.
 * @param array $value The values to put into the input fields.
 * @return void echos the page
 */
function renderPageM5(array $value = []): void
{
    SharedHtmlRendererM5::renderFormArrayBased(array_keys(INPUT_FIELDS_M5T4), INPUT_FIELDS_M5T4, $value);
}

/**
 * Processes the form.
 * This logic currently favors the first input field. If both are filled, the first one will be used.
 * Unless the first one does not contain a number, then the second one will be used.
 * @return void echos the page
 */
function processFormM5(): void
{
    // If there is something in the encrypting input field, encrypt it, and render the page.
    if (!empty($_POST[ENCRYPTING])) {
        renderPageM5([
            '',
            Encryption::carstenCipherEncrypt($_POST[ENCRYPTING])
        ]);

        // The task specifies to remove the input form for encryption after it is used for some reason.
        // JavaScript for the rescue. Remove the next echo, to see how I intended it to look like.
        echo <<<JS
            <script> 
            // Get the elements to remove.
            var encryptForm = document.getElementById("Encrypt");
            var encryptFormLabel = document.getElementById("Encrypt.Label");
            // Remove the first input form and it's label.
            encryptForm.parentNode.removeChild(encryptForm)
            encryptFormLabel.parentNode.removeChild(encryptFormLabel)
            </script>
            JS;

        return;
    }
    if (!empty($_POST[DECRYPTING])) {
        renderPageM5([
            Encryption::carstenCipherDecrypt($_POST[DECRYPTING]),
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
