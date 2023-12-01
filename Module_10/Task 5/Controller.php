<?php
include '../sharedViewTop.php';


$directory = dirname(__DIR__); // Path to the directory to be scanned
echo "<p>Directory listing for $directory</p>";
// Open the directory to the handle $handle
if ($handle = opendir($directory)) {
    echo "<table>";
    echo "<tr><th>Filename</th><th>Type</th><th>Size (Bytes)</th><th>Last Modified</th><th>Permissions</th></tr>";

    while (false !== ($file = readdir($handle))) {
        if ($file != "." && $file != "..") {
            echo "<tr>";
            echo "<td>$file</td>";
            echo "<td>" . filetype($directory . '/' . $file) . "</td>";
            echo "<td>" . filesize($directory . '/' . $file) . "</td>";
            echo "<td>" . date("F d Y H:i:s.", filemtime($directory . '/' . $file)) . "</td>";
            echo "<td>" . (is_readable($directory . '/' . $file) ? 'Readable ' : '') .
                (is_writable($directory . '/' . $file) ? 'Writable ' : '') .
                (is_executable($directory . '/' . $file) ? 'Executable' : '') . "</td>";
            echo "</tr>";
        }
    }
    echo "</table>";
    closedir($handle);
}


include '../sharedViewBottom.php';
