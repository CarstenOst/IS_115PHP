<?php


namespace Database;
// with DB_HOST_NAME, DB_NAME and DB_PASSWORD constants
// Note: you might have to add another constant for the username, as our db has same name and username for simplicity
use PDO;
use PDOException;

class DBConnector
{
    /**
     * This static method returns a PHP Data Object (PDO) connection to the database.
     * Note, remember to add DBConfig.php with connection constants.
     *
     * @return PDO|null Returns a PDO connection to the database, or null if an exception is thrown.
     * @throws PDOException Throws a PDOException if the connection fails.
     *
     */
    public static function getConnection(): ?PDO
    {
        try {
            $conn = new PDO(
                "mysql:host=" . DBConfig::DB_HOST_NAME . ";dbname=" . DBConfig::DB_NAME,
                DBConfig::DB_USER_NAME,
                DBConfig::DB_PASSWORD);

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->exec("set names utf8");
        } catch (PDOException $exception) {
            // TODO add logging
            // TODO do not echo exceptions to the user
            echo "Connection error: " . $exception->getMessage();
        }

        return $conn ?? null;
    }
}
