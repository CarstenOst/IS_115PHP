<?php
include '../sharedViewTop.php';

// One language (English).
// PascalCase on classes, and camelCase on functions and variables.
// Strict typing - to reduce runtime errors.

// display video
echo "<video controls style=\"position: absolute; top: 50px; left: 0; width: 100%; height: calc(100% - 50px); border: none;\">
            <source src=\"GoodCode.mkv\" type=\"video/mp4\">
        </video>";


include '../sharedViewBottom.php';
