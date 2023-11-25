<?php

class User2
{
    public string $firstName;
    public string $lastName;
    protected string $userName;
    public DateTime $birthDate;
    protected DateTime $createdAt;

    private static array $deletedUsernames = [];

    public function __construct(string $firstName, string $lastName, DateTime $birthDate)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->birthDate = $birthDate;
        $this->userName = substr(
            md5(uniqid(rand(), true)
            ), 0, 8); // Random username
        $this->createdAt = new DateTime(); // Set current date and time as registration date
    }

    public function getFullName(): string
    {
        return $this->firstName . ' ' . $this->lastName;
    }

    public function getCreatedDate(): DateTime
    {
        return $this->createdAt;
    }

    public function getUserName(): string
    {
        return $this->userName;
    }

    public static function showDeletedUsernames(): array
    {
        return self::$deletedUsernames;
    }

    public function __destruct()
    {
        self::$deletedUsernames[] = $this->userName;
    }

}

