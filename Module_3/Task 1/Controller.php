<?php
require 'Event.php';
require 'DateChecker.php';
require '../PostHandler.php';
require '../sharedViewTop.php';


require '../sharedViewTop.php';


$event1 = new Event("NeonParty", "eventdescription1", "eventcontact1", "eventlocation1", "Europe/Paris", "2023-08-20 6:22:00", "PT4H");
$event2 = new Event("Black and White", "eventdescription1", "eventcontact1", "eventlocation1", "Europe/Paris", "2023-08-20 6:22:00", "PT4H");


function printEvent($event): void
{


    foreach ($event as $item):
        $eventName = $item->getEventName();
        $eventDescription = $item->getEventDescription();
        $eventContact = $item->getEventContact();
        $eventLocation = $item->getEventLocation();
        $eventTimeZone = $item->getEventTimeZone()->getName();
        $eventDate = $item->getEventDate()->format('d/m/Y H:i:s');
        $eventDuration = $item->getEventDuration()->format('%h hours, %i minutes');
        $eventEndDate = $item->getEventEndDate()->format('d/m/Y H:i:s');


        ?>
        <div class="suggestion-div mt-4 shadow-sm m-sm-2" style="padding-left: 5px;">
            <table class="suggestion-table">
                <tr>
                    <td class="text-center pt-2" style="width: 60px;">

                    </td>
                    <td colspan="3" class="suggestion-title" style="padding-right: 6px;">
                        <?php
                        $titleLength = strlen($eventName);
                        if ($titleLength > 50) {
                            echo substr($eventName, 0, 50) . "...";
                        } else {
                            echo $eventName;
                        }
                        ?>

                    </td>
                </tr>
                <tr>
                    <td class="text-center pb-2"><?php echo $eventContact; ?></td>
                    <td style="text-align: left; padding-left: 5px;" class="pb-2 col-3 text-nowrap">
                        <?php
                        switch ($eventDescription) {
                            case "Godkjent":
                                // ...
                                break;
                            // ...
                            default:
                                echo '<span class="">' . $eventDescription . '</span>';
                                break;
                        }
                        ?>
                    </td>
                    <td style="text-align: center" class="pb-2 col-3"><?php echo $eventLocation; ?></td>
                    <td style="text-align: right; padding-right: 10px;" class="pb-2 col-3">
                        <span class="text-nowrap d-none d-sm-inline">
                            <i class="fa fa-calendar-plus-o" style="margin-right: 3px;" aria-hidden="true"></i>
                            Begins <?php echo $eventDate; ?><br/>
                        </span>
                        <?php
                        $dateToday = new DateTime();
                        $suggestionDueDate = $item->getEventEndDate();
                        $daysLeft = $suggestionDueDate->diff($dateToday)->days;
                        $daysLeftRounded = round($daysLeft);

                        if ($daysLeftRounded <= 0) {
                            // ...
                        } else {
                            // ...
                        }
                        ?>
                    </td>
                </tr>
            </table>
            </a>
        </div>
    <?php endforeach;
}


printEvent([$event1, $event2]);

$eventTitle = $event1->getEventName();


if (DateChecker::isOldDate($event1->getEventEndDate())) {
    echo "$eventTitle is an old event. It ended on " . $event1->getEventEndDate()->format('d/m/Y H:i:s') . ".";
} else if (DateChecker::isOldDate($event1->getEventDate())) {
    echo "$eventTitle is a current event";
} else {
    echo "$eventTitle is a future event";
}


require '../sharedViewBottom.php';