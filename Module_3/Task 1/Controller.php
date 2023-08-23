<?php
require 'Event.php';
require 'DateChecker.php';
require '../PostHandler.php';

require '../sharedViewTop.php';


$event1 = new Event("NeonParty", "eventdesc1", "eventco1", "Eidehallen", "Europe/Paris", "2023-08-20 6:22:00", "PT4H");
$event2 = new Event("Black and White", "eventdesc2", "eventco2", "Gimlehallen", "Europe/Paris", "2023-08-20 6:22:00", "PT4H");


function printEvent($event): void
{
    foreach ($event as $item) {
        $eventName = $item->getEventName();
        $eventDescription = $item->getEventDescription();
        $eventContact = $item->getEventContact();
        $eventLocation = $item->getEventLocation();
        $eventTimeZone = $item->getEventTimeZone()->getName();
        $eventDate = $item->getEventDate()->format('d/m/Y H:i:s');
        $eventDuration = $item->getEventDuration()->format('%h hours, %i minutes');
        $eventEndDate = $item->getEventEndDate()->format('d/m/Y H:i:s');

        echo '<br>';
        echo $eventName . '<br>';

        echo $eventLocation. '<br>';
        echo $eventDate. '<br>';

        $dateToday = new DateTime();
        $eventEndDate = $item->getEventEndDate();
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
}


printEvent([$event1, $event2]);

$eventTitle = $event1->getEventName();


if (DateChecker::isOldDate($event1->getEventEndDate())) {
    echo "$eventTitle is an old event. <br> It ended on " . $event1->getEventEndDate()->format('d/m/Y H:i:s') . ".";
    return;
}
if (DateChecker::isOldDate($event1->getEventDate())) {
    echo "$eventTitle is a current event";
    return;
}
echo "$eventTitle is a future event";

echo '<br><br>';
$eventTitle = $event2->getEventName();


if (DateChecker::isOldDate($event2->getEventEndDate())) {
    echo "$eventTitle is an old event. <br> It ended on " . $event2->getEventEndDate()->format('d/m/Y H:i:s') . ".";
    return;
}
if (DateChecker::isOldDate($event2->getEventDate())) {
    echo "$eventTitle is a current event";
    return;
}
echo "$eventTitle is a future event";


require '../sharedViewBottom.php';