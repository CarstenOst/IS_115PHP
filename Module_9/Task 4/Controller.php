<?php
include '../sharedViewTop.php';


if (isset($_GET['download'])) {
    $file = './Hidden.php'; // Path to the file to be downloaded

    if (file_exists($file)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="' . basename($file) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        readfile($file);
        exit;
    }
}
?>

    <a href="Controller.php?download=true">Download pdf

<?php
include '../sharedViewBottom.php';
