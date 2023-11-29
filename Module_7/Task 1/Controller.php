<?php
include '../sharedViewTop.php';
include '../autoloader.php';

use Repositories\BookingRepository;
use Repositories\UserRepository;

session_start();
$_SESSION[SessionConst::USER_ID] = 2;

?>

<body>
<div class="main-view">

    <div style="color: #000000" class="booking-view">
        <div>
            <h2>Your bookings today</h2>
        </div>
        <form method='POST' action=''>
            <table class='calendar'>
                <?php

                // TODO move this section into own method for student (view their bookings with tutors) and tutors (view their booked timeslots with students)
                // Queries database for bookings for hour interval 08-23
                $today = new DateTime();
                $bookings = BookingRepository::getStudentBookings($today, $_SESSION[SessionConst::USER_ID]);
                if (sizeof($bookings) == 0) {
                    echo "<br>Seems like you have no future bookings...";
                } else {
                    // Creates headers for table
                    $boookingHeaders = ["Booking date", "Location", "Tutor", "Cancel Timeslot", "Message", "Add to calendar"];
                    echo "<tr>";
                    foreach ($boookingHeaders as $header) {
                        echo "<th>$header</th>";
                    }
                    echo "</tr>";

                    // Populates table with booking rows
                    foreach ($bookings as $booking) {
                        $tutorId = $booking->getTutorId();
                        $tutorName = UserRepository::read($tutorId)->getFirstName();
                        $bookingId = $booking->getBookingId();
                        echo "
                            <tr>
                                <td>
                                    <i class='calendar-icon fa-regular fa-calendar'></i> {$booking->getBookingTime()->format('d-m')}
                                    <br>
                                    <i class='clock-icon fa-regular fa-clock'></i> {$booking->getBookingTime()->format('H:i')}
                                </td>
                                <td>
                                    <i class='location-icon fa-regular fa-location-dot'></i> {$booking->getStatus()}
                                </td>
                                <td>
                                    <i class='fa-solid fa-user'></i> {$tutorName}
                                </td>
                                <td>
                                    <button class='table-button' onclick='confirmCancelation($bookingId)'><i class='cancel-icon fa-solid fa-ban'></i> Cancel</button>
                                </td>
                                <td>
                                    <button class='table-button' onclick='messageTutor($tutorId)'><i class='message-icon fa-solid fa-message'></i> Message</button>
                                </td>
                                <td>
                                    <button class='table-button'><i class='calendar-icon fa-regular fa-calendar-plus'></i> Add boooking</button>
                                </td>
                            </tr>
                        ";
                    }

                }

                ?>

            </table>
        </form>
    </div>


</div>

</body>

<?php
include '../sharedViewBottom.php';
