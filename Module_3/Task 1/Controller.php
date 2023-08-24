<?php
require 'Event.php';
require 'DateChecker.php';
require '../PostHandler.php';

require '../sharedViewTop.php';


$event1 = new Event("NeonParty", "eventdesc1", "eventco1", "Eidehallen", "Europe/Paris", "2023-08-28 6:00:00", "PT4H");
$event2 = new Event("Black and White", "eventdesc2", "eventco2", "Gimlehallen", "Europe/Paris", "2023-08-20 12:30:00", "PT4H");

/**
 * Prints the event
 * @param Event $event need type event, should have used an interface, but whatever
 * @return void
 */
function printEvent(Event $event): void
{

    $eventName = $event->getEventName();
    $eventDescription = $event->getEventDescription();
    $eventContact = $event->getEventContact();
    $eventLocation = $event->getEventLocation();
    $eventTimeZone = $event->getEventTimeZone()->getName();
    $eventDate = $event->getEventDate()->format('d/m/Y H:i:s');
    $eventDuration = $event->getEventDuration()->format('%h hours, %i minutes');
    $eventEndDate = $event->getEventEndDate()->format('d/m/Y H:i:s');

    echo '<br>';
    echo "Name: $eventName <br>";

    echo "Location: $eventLocation <br>";
    echo "Date: $eventDate <br>";

    $dateToday = new DateTime();
    $eventEndDate = $event->getEventEndDate();
    $daysLeft = $eventEndDate->diff($dateToday)->days;
    $daysLeftRounded = round($daysLeft);
    if ($dateToday > $eventEndDate) {
        $daysLeftRounded = -$daysLeftRounded;
    }

    if ($daysLeftRounded >= 0) {
        echo $daysLeftRounded . ' days until event <br>';
    } else {
        echo -$daysLeftRounded . ' days old <br>';
    }
    echo '<br>';

}

/**
 * Logic to print if the date is old, new, or currently happening
 * @param Event $event
 * @return void
 */
function printIfOldDate(Event $event): void
{
    $eventTitle = $event->getEventName();
    if (DateChecker::isOldDate($event->getEventEndDate())) {
        echo "$eventTitle is an old event. <br> It ended on " . $event->getEventEndDate()->format('d/m/Y H:i:s') . ".";
        return;
    }
    if (DateChecker::isOldDate($event->getEventDate())) {
        echo "$eventTitle is a current event";
        return;
    }
    echo "$eventTitle is a future event";
}



// Print event 1
printEvent($event1);
printIfOldDate($event1);

echo '<br>__________________________________<br>';

// Print event 2
printEvent($event2);
printIfOldDate($event2);







// Finish page
require '../sharedViewBottom.php';