<?php
include '../sharedViewTop.php';


if (isset($_GET['download'])) {
    $file = '../Hidden/mod10.pdf'; // Path to the file to be downloaded

    if (file_exists($file)) {
        header("Content-Type: application/pdf");
        header("Content-Disposition: attachment; filename=\"mod10.pdf\"");
        header("Content-Length: " . filesize($file));
        readfile($file);
        exit;
    }
}
?>

<a href="Controller.php?download=true">Download pdf


