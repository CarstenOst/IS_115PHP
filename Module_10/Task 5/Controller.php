<?php
include '../sharedViewTop.php';
?>
    <head>
        <title>Booking API Calls</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script type="text/javascript">
            function callAPI(url) {
                $.get(url, function(data) {
                    // Display response in the HTML body
                    document.getElementById('apiResponse').innerHTML = 'Response: ' + JSON.stringify(data);
                }).fail(function() {
                    // Display error message in the HTML body
                    document.getElementById('apiResponse').innerHTML = 'Error calling the API';
                });
            }
        </script>
    </head>
    <body>
    <h2>Booking System API Calls</h2>
    <button onclick="callAPI('BookingAPI.php?action=getBookingById&id=1')">Get Booking By ID (1)</button><br>
    <button onclick="callAPI('BookingAPI.php?action=getBookingsByTutor&tutor_id=37')">Get Bookings By Tutor (ID 37)</button><br>
    <button onclick="callAPI('BookingAPI.php?action=getBookingsByStudent&student_id=36')">Get Bookings By Student (ID 36)</button><br>
    <button onclick="callAPI('BookingAPI.php?action=getBookingsByMonth&month=12')">Get Bookings By Month (December)</button>
    <br><br>
    <div id="apiResponse"></div>
    </body>

<?php
include '../sharedViewBottom.php';
