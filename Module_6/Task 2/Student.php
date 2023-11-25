<?php
include '../Task 1/User.php';

// Module 6 T2, Create a method that overrides a method in User
class Student extends User
{
    public string $studyProgram;

    public function __construct(
        string   $firstName,
        string   $lastName,
        string   $userName,
        DateTime $birthDay,
        string   $studyProgram)
    {
        parent::__construct($firstName, $lastName, $userName, $birthDay);

        $this->studyProgram = $studyProgram;
    }

    public function getFullName(): string
    {
        return 'Student: ' . parent::getFullName();
    }

    public function getStudyProgram(): string
    {
        return $this->studyProgram;
    }

}
