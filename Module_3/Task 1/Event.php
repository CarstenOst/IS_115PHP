<?php

class Event
{
    private string $eventName;
    private string $eventDescription;
    private string $eventContact;
    private string $eventLocation;
    private DateTimeImmutable $eventDate;
    private DateInterval $eventDuration;
    private DateTimeImmutable $eventEndDate;

    // Constructor

    /**
     * @throws Exception
     */
    public function __construct(
        string $eventName,
        string $eventDescription,
        string $eventContact,
        string $eventLocation,
        string $eventDate,
        string $eventDuration
    ) {
        $this->eventName = $eventName;
        $this->eventDescription = $eventDescription;
        $this->eventContact = $eventContact;
        $this->eventLocation = $eventLocation;
        $this->eventDate = new DateTimeImmutable($eventDate);
        $this->eventDuration = new DateInterval($eventDuration);
        $this->eventEndDate = $this->eventDate->add($this->eventDuration);

    }

    //
    //
    //
    // Setters
    //
    //
    //

    // setEventName
    public function setEventName(string $eventName): void {
        $this->eventName = $eventName;
    }
    // setEventDescription
    public function setEventDescription(string $eventDescription): void {
        $this->eventDescription = $eventDescription;
    }
    // setEventContact
    public function setEventContact(string $eventContact): void {
        $this->eventContact = $eventContact;
    }
    // setEventLocation
    public function setEventLocation(string $eventLocation): void {
        $this->eventLocation = $eventLocation;
    }
    // setEventDate
    public function setEventDate(DateTimeImmutable $eventDate): void {
        $this->eventDate = $eventDate;
    }
    // setEventDuration
    public function setEventDuration(DateInterval $eventDuration): void {
        $this->eventDuration = $eventDuration;
    }
    // setEventEndDate
    public function setEventEndDate(DateTimeImmutable $eventEndDate): void {
        $this->eventEndDate = $eventEndDate;
    }

    //
    //
    //
    // Getters
    //
    //
    //

    // getEventName
    public function getEventName(): string {
        return $this->eventName;
    }
    // getEventDescription
    public function getEventDescription(): string {
        return $this->eventDescription;
    }
    // getEventContact
    public function getEventContact(): string {
        return $this->eventContact;
    }
    // getEventLocation
    public function getEventLocation(): string {
        return $this->eventLocation;
    }
    // getEventDate
    public function getEventDate(): DateTimeImmutable {
        return $this->eventDate;
    }
    // getEventDuration
    public function getEventDuration(): DateInterval {
        return $this->eventDuration;
    }
    // getEventEndDate
    public function getEventEndDate(): DateTimeImmutable {
        return $this->eventEndDate;
    }
}