<?php

class JobAd
{
    private string $jobTitle;
    private string $jobDescription;
    private string $jobContact;
    private string $jobCompany;
    private string $jobLocation;
    private string $jobSalary;
    private string $jobDate;

    // Constructor
    public function __construct(
        string $jobTitle,
        string $jobDescription,
        string $jobContact,
        string $jobCompany,
        string $jobLocation,
        string $jobSalary,
        string $jobDate
    )
    {
        $this->jobTitle = $jobTitle;
        $this->jobDescription = $jobDescription;
        $this->jobContact = $jobContact;
        $this->jobCompany = $jobCompany;
        $this->jobLocation = $jobLocation;
        $this->jobSalary = $jobSalary;
        $this->jobDate = $jobDate;
    }

    // Getters
    public function getJobTitle(): string
    {
        return $this->jobTitle;
    }

    public function getJobDescription(): string
    {
        return $this->jobDescription;
    }

    public function getJobContact(): string
    {
        return $this->jobContact;
    }

    public function getJobCompany(): string
    {
        return $this->jobCompany;
    }

    public function getJobLocation(): string
    {
        return $this->jobLocation;
    }

    public function getJobSalary(): string
    {
        return $this->jobSalary;
    }

    public function getJobDate(): string
    {
        return $this->jobDate;
    }

    // Setters
    public function setJobTitle(string $jobTitle): void
    {
        $this->jobTitle = $jobTitle;
    }

    public function setJobDescription(string $jobDescription): void
    {
        $this->jobDescription = $jobDescription;
    }

    public function setJobContact(string $jobContact): void
    {
        $this->jobContact = $jobContact;
    }

    public function setJobCompany(string $jobCompany): void
    {
        $this->jobCompany = $jobCompany;
    }

    public function setJobLocation(string $jobLocation): void
    {
        $this->jobLocation = $jobLocation;
    }

    public function setJobSalary(string $jobSalary): void
    {
        $this->jobSalary = $jobSalary;
    }

    public function setJobDate(string $jobDate): void
    {
        $this->jobDate = $jobDate;
    }

}