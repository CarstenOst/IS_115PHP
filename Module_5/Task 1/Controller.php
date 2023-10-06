<?php
include '../sharedViewTop.php';
$start = microtime(true);
for ($i = 0; $i < 10000000; $i++) {
    $a = array(1, 2, 3);
}
echo 'array() took: ', microtime(true) - $start, " seconds\n";

echo '<br>';

$start = microtime(true);
for ($i = 0; $i < 10000000; $i++) {
    $a = [1, 2, 3];
}
echo '[] took: ', microtime(true) - $start, " seconds\n";
include '../sharedViewBottom.php';
