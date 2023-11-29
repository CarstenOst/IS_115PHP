<?php

namespace Models;


use DateTime;

class User
{
    private int $userId;
    private string $userType;
    private string $firstName;
    private string $lastName;
    private string $email;
    private string $password;
    private ?string $about;
    private ?string $favoriteTutor1;
    private ?string $favoriteTutor2;

    private DateTime $createdAt;
    private DateTime $updatedAt;

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): self
    {
        $this->userId = $userId;
        return $this;
    }

    public function getUserType(): string
    {
        return $this->userType;
    }

    public function setUserType(string $userType): self
    {
        $this->userType = $userType;
        return $this;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;
        return $this;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    public function getAbout(): string
    {
        return $this->about;
    }

    public function setAbout($about = ''): self
    {
        $this->about = $about;
        return $this;
    }

    public function getFavoriteTutor1(): ?string
    {
        return $this->favoriteTutor1;
    }

    public function setFavoriteTutor1($favoriteTutor1): self
    {
        $this->favoriteTutor1 = $favoriteTutor1;
        return $this;
    }

    public function getFavoriteTutor2(): ?string
    {
        return $this->favoriteTutor2;
    }

    public function setFavoriteTutor2($favoriteTutor2): self
    {
        $this->favoriteTutor2 = $favoriteTutor2;
        return $this;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(DateTime $updatedAt): self
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
}

