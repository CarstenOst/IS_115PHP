<?php

if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) {
    header('Location: ../index.php');
    exit;
}

class Counter
{
    /**
     * @param int $num
     * @return void
     */
    public static function count(int $num): void {
        $sum = 0;
        $echoString = '';
        for ($i = 1; $i <= $num; $i++) {
            if ($i != 1 xor $i < $num) {
                $echoString = $echoString . $i . ' + ';
            } else {
                $echoString = $echoString . $i;
            }
            echo '<br>';
            echo "The sum of $echoString is: " . $sum += $i;
            echo '<br>';
        }
    }
}