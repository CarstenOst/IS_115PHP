<?php
include '../sharedViewTop.php';

/**
 * Function to download a file
 *
 * @param string $filePath
 * @param string $fileName
 * @return void downloads the file
 */
function downloadFile(string $filePath, string $fileName): void
{
    if (file_exists($filePath)) {
        // Set headers to download the file
        header('Content-Description: File Transfer');
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="' . basename($fileName) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filePath));

        // Clean the output buffer
        ob_end_clean();

        // Read the file and send it to the output
        readfile($filePath);
        exit;
    }
    echo "File not found.";

}

// Check if the download request is set
if (isset($_GET['download'])) {

    $fileName = $_GET['download']; // Name to send to the client
    $filePath = "./Hidden/$fileName.pdf"; // Absolute path to the file

    if ($fileName === 'mod10' || $fileName === 'mod9') {
        downloadFile($filePath, "$fileName.pdf");
    } else {
        echo "File not found.";
    }

}

?>

<a href="?download=mod10">Download module 10 pdf</a>
<br>
<br>
<a href="?download=mod9">Download module 9 pdf</a>


