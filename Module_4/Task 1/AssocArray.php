<?php

class AssocArray
{
    /**
     * Warning: This function will overwrite the variable passed as first parameter
     * Creates an array with keys from the given parameters
     *
     * @param $arr - array to be created; WARNING WILL OVERWRITE the variable passed as first parameter
     * @param int ...$arrayKey - keys for the array
     * Value will always be 1
     */
    public static function create(&$arr, int ...$arrayKey): void
    {
        $arr = [];
        if (!$arrayKey) {
            return;
        }

        foreach ($arrayKey as $key) {
            $arr[$key] = 1; // Task didn't specify a value, so I just set it to 1.
        }
    }


    /**
     * Prints out an assoc array (both key and value) with the given html code below
     *
     * @param array $assocArray
     * @return void echos the html code
     */
    public static function print(array $assocArray): void
    {
        foreach ($assocArray as $key => $value) {
            echo "Key: $key, Value: $value <br>";
        }
    }
}
