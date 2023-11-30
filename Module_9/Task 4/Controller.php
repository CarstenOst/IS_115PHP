<?php
include '../sharedViewTop.php';


if (isset($_GET['download'])) {
    $file = '../Task 5/Mod9TemplateOutput.pdf'; // Path to the file to be downloaded

    if (file_exists($file)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="' . basename($file) . '"');
        header('Expires: 0'); // Extra stuff
        header('Cache-Control: must-revalidate'); // Extra stuff
        header('Pragma: public'); // Extra stuff
        header('Content-Length: ' . filesize($file)); // Extra stuff
        readfile($file);
        exit;
    }
}
?>

    <a href="Controller.php?download=true">Download pdf

<?php
include '../sharedViewBottom.php';
