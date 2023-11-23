<?php
include '../Task 1/User.php';

// Module 6 T2, Create a method that overrides a method in User
class Student2 extends User2
{
    public string $studyProgram;

    public function __construct(
        string   $firstName,
        string   $lastName,
        DateTime $birthDay,
        string   $studyProgram)
    {
        parent::__construct($firstName, $lastName, $birthDay);

        $this->studyProgram = $studyProgram;
    }

    public function getFullName(): string
    {
        return parent::getFullName();
    }

    public function getStudyProgram(): string
    {
        return $this->studyProgram;
    }

}
