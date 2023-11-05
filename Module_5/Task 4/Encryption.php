<?php
// The following code is a code from a previous project in GO lang
// See https://github.com/CarstenOst/carCipher/blob/main/carcipher.go for more info.
class Encryption
{
    /**
     * Returns 3 if input is dividable by 2, and so on.
     *
     * @param int $i
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
     * The whole point is security through obscurity, so you can try to figure out some parts yourself :)
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
            // echo $message[$i] . ' = ' . $asciiNumber . '<br>'; // Uncomment this line, to understand a little more.
            $encryptMessage[$i] = self::carCipher($asciiNumber, $encryptWith, $i);
        }

        return implode("", array_map("mb_chr", $encryptMessage));
    }


    /**
     * Method to encrypt a string.
     * @param string $message The message to encrypt.
     * @return string encrypted message
     */
    public static function carstenCipherEncrypt(string $message): string
    {
        return self::encrypt(mb_str_split($message), 3);
    }

    /** Method to decrypt an encrypted string made with the encrypt function.
     * @param string $message The encrypted string to decrypt back to plaintext.
     * @return string Plaintext of the encrypted string
     *
     * Note, this method will fail if the ascii character numbers is not dividable by 2.
     * Therefore, it should only ever get input from already encrypted strings.
     */
    public static function carstenCipherDecrypt(string $message): string
    {
        return self::encrypt(mb_str_split($message), -3);
    }
}
