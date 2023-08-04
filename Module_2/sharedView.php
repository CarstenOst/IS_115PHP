<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="../styles.css">
    <script src="../script.js"></script>
    <title>Module_2</title>
</head>
<body>
<div class="center">
    <nav id="navbar" style="align-items: center" >
        <?php buttons() ?>
    </nav>
    <div id="content" class="center" style="padding-top: 55px;">
        <?php cookieButton() ?>
    </div>
</div>
</body>
</html>


<?php
require_once 'CookieHelper.php';
function buttons(): void
{
    // Here you can see my best solution for finding the right dir for the button path
    $currentDir = __DIR__;
    $requestURI = $_SERVER['REQUEST_URI'];

    // Finding the position of "Module_2" in the request URI
    $modulePos = strpos($requestURI, 'Module_2');

    // Extracting the base URL up to and including the "Module_2" directory
    $baseURL = "http://" . $_SERVER['HTTP_HOST'] . substr($requestURI, 0, $modulePos) . 'Module_2/';
    $directories = scandir($currentDir);

    foreach ($directories as $dir) {
        if ($dir != "." && $dir != ".." && is_dir($currentDir . '/' . $dir)) {
            $url = $baseURL . "$dir/Controller.php";
            echo "<a href=\"$url\"><button id=\"$dir\">$dir</button></a>";
        }
    }
}

function cookieButton(): void
{
    if (CookieHelper::hasTargetCookies()) {
        echo '<form method="POST">';
        echo '    <button type="submit" name="remove_cookies">Remove All Cookies</button>';
        echo '</form>';
    }
}
