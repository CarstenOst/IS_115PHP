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
            Encryption::carstenCipherEncrypt($_POST[ENCRYPTING])
        ]);

        // The task specifies to remove the input form for encryption for some reason.
        // JavaScript for the rescue. Remove this, to see how it really should look like, if the task was made properly.
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
    } elseif (!empty($_POST[DECRYPTING])) {
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
