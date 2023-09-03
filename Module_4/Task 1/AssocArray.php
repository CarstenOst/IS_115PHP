<?php

class AssocArray
{
    /**
     * Warning: This function will overwrite the variable passed as first parameter
     * Creates an array with keys from the given parameters
     * @param $arr - array to be created; WARNING WILL OVERWRITE
     * @param int ...$arrayKey - keys for the array
     * Value will always be 1
     */
    public static function create(&$arr ,int ...$arrayKey): void
    {
        $arr = [];
        if (!$arrayKey) {
            return;
        }

        foreach ($arrayKey as $key) {
            $arr[$key] = 1;
        }
    }


    /**
     * WARNING: THIS MIGHT OVERWRITE THE ARRAY IF KEY IS ALREADY USED
     * Takes a pointer to the first parameter value, and either adds or overwrites the value (if a key is the same) with the given keys
     * Be aware of side effects
     * @param array $arr - array to be modified
     * @param int ...$arrayKey - keys for the array
     * @return bool - true if array was modified, false if not
     */
    public static function modify(array &$arr ,int ...$arrayKey): bool
    {
        if (!$arrayKey) {
            return false;
        }

        foreach ($arrayKey as $key) {
            $arr[$key] = 1;
        }
        return true;
    }

    /**
     * Prints out an assoc array (both key and value) with the given html code below
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