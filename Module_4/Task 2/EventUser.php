<?php

class EventUser
{
    private string $name;
    private string $email;
    private string $phoneNumber; // Don't need math on a phone number anyway, so string is fine

    public function __construct(string $name, string $email, string $phoneNumber)
    {
        $this->name = $name;
        $this->email = $email;
        $this->phoneNumber = $phoneNumber;
    }

    // Getters
    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

}