<?php
require '../sharedViewTop.php';


// So here everything is hardcoded, because I spent way to long time on task 2/3
// Not even using datetime. ¯\_(ツ)_/¯
$tutoringSessions = [
    [
        'title' => 'Mathematics Tutoring',
        'description' => 'Tutoring in linear algebra and calculus.',
        'tutoringTime' => '2023-10-05 14:00',
        'location' => 'Room 101, Main Building'
    ],
    [
        'title' => 'Programming Tutoring',
        'description' => 'Introduction to Python and data structures.',
        'tutoringTime' => '2023-10-06 16:00',
        'location' => 'Room 202, Computer Lab'
    ],
    [
        'title' => 'History Tutoring',
        'description' => 'Deep dive into European medieval history.',
        'tutoringTime' => '2023-10-07 13:00',
        'location' => 'Room 303, History Building'
    ]
];


// Table with some bootstrap styling.
echo '<div class="w-100">
      <table class="table mx-auto">
      <thead class="thead-dark">
          <tr class="text-left">
              <th>Title</th>
              <th>Description</th>
              <th>Tutoring Time</th>
              <th>Location</th>
          </tr>
      </thead>
      <tbody>';

// Session not to be confused with PHP sessions
foreach ($tutoringSessions as $session) {
    echo '<tr class="text-left">
          <td>' . $session['title'] . '</td>
          <td>' . $session['description'] . '</td>
          <td>' . $session['tutoringTime'] . '</td>
          <td>' . $session['location'] . '</td>
          </tr>';
}
// Close the table
echo '</tbody>
      </table>
      </div>';





require '../sharedViewBottom.php';
