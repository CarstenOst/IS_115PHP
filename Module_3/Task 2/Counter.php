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
        $unCleansedNumberLine = '';
        for ($i = 1; $i <= $num; $i++) {

            $unCleansedNumberLine .= $i . ' + ';

            $numberLine = substr($unCleansedNumberLine, 0, -2);

            echo '<br>';
            echo "The sum of $numberLine = " . $sum += $i;
            echo '<br>';
        }
    }
}