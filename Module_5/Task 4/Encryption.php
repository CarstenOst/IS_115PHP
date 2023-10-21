<?php
// The following code is a code from a previous project in GO lang
// See https://github.com/CarstenOst/carCipher/blob/main/carcipher.go for more info.
class Encryption
{
    /**
     * Returns 3 if input is dividable by 2.
     *
     * @param int $i Input a
     * @return int "3" if dividable by 2 and "0" if not.
     */
    private static function extraSecurity(int $i): int
    {
        if ($i % 2 == 0) {
            return 3;
        }
        if ($i % 3 == 0) {
            return 4;
        }
        if ($i % 5 == 0) {
            return -3;
        }
        if ($i % 7 == 0) {
            return 2;
        }
        return 0;
    }

    /**
     * The whole point is security through obscurity, so you can try to figure it out yourself :)
     * It's called carCipher because it's the three first letters of my name
     *
     * STRING MUST BE ENCRYPTED WITH POSITIVE INTEGER
     * TO DECRYPT USE A NEGATIVE NUMBER CORRESPONDING TO THE POSITIVE INTEGER
     * EXAMPLE: encodedString = carCipher(num, 3, index);
     * EXAMPLE: decodedString = carCipher(num, -3, index);
     *
     * @param float|int $asciiNumber
     * @param int $encryptWith positive for encryption, negative for decryption
     * @param int $i
     * @return int|float
     */
    private static function carCipher(float|int $asciiNumber, int $encryptWith, int $i): int|float
    {
        // this makes it so that certain numbers is not changed at all, to add to the confusion
        if ($encryptWith > 0) {
            if ($asciiNumber % 2 == 0) {
                $asciiNumber *= $encryptWith;
            }
            // The extraSecurity function will sometimes add a value, and sometimes not,
            // depending on the length of the string
            return $asciiNumber + self::extraSecurity($i);
        }

        // Same as above, but in reverse
        if ($encryptWith < 0) {
            $asciiNumber -= self::extraSecurity($i);
            if ($asciiNumber % 2 == 0) {
                $asciiNumber = abs(intdiv($asciiNumber, $encryptWith)); // abs() to counter negativity :)
            }
            return $asciiNumber;
        }
        return $asciiNumber;
    }


    /**
     * This function turns the message into ascii-numbers, and returns the final encryption as a string.
     *
     * @param array $message The message as an array with only one character in each index.
     * @param int $encryptWith An int to be passed to the security functions later on (not good practice).
     * @return string Encrypted or decrypted depending on positive or negative "$encryptWith".
     */
    private static function encrypt(array $message, int $encryptWith): string
    {
        $encryptMessage = [];
        for ($i = 0; $i < count($message); $i++) {
            $asciiNumber = mb_ord($message[$i]);
            echo $message[$i] . ' = ' . $asciiNumber . '<br>';
            $encryptMessage[$i] = self::carCipher($asciiNumber, $encryptWith, $i);
        }

        return implode("", array_map("mb_chr", $encryptMessage));
    }


    /**
     * So this is the ciphers endpoint, encapsulating the rest of the code.
     * You can use this code for both encrypting and decrypting.
     *
     * @param string $message The message to encrypt.
     * @param int $encryptWith It must be positive when encrypting
     * and it must be negative to decrypt. Does not need to be high values to be effective.
     * Usage:
     * Example: $encryptedText = carstenCipher('WubbaLubbaDubDub', 3); // $encryptedText = "ZuĩĪdáxĨĩeÏuĩÌxĪ";
     * Example: $decryptedText = carstenCipher($encryptedText, -3); // $decryptedText = "WubbaLubbaDubDub";
     *
     * @return string
     */
    public static function carstenCipher(string $message, int $encryptWith = 3): string
    {
        if ($encryptWith == 0) {
            echo "Warning, you have not encrypted your message\n";
            return $message;
        }
        return self::encrypt(mb_str_split($message), $encryptWith);
    }
}
