<?php


class User
{
    protected string $firstName;
    protected string $lastName;
    protected string $userName;
    protected DateTime $birthDay;
    protected DateTime $createdAt;


    public function __construct(
        string   $firstName,
        string   $lastName,
        string   $userName,
        DateTime $birthDay,
    )
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->userName = $userName;
        $this->birthDay = $birthDay;
        $this->createdAt = new DateTime();
    }

    public function getFullName(): string
    {
        return $this->firstName . ' ' . $this->lastName;
    }

    public function getAge(): int
    {
        $today = new DateTime();
        $age = $today->diff($this->birthDay);
        return $age->y;
    }
}

