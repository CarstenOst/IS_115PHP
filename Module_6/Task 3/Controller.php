<?php
include '../sharedViewTop.php';
include 'User2.php';
include 'Student2.php';

// some students
$student1 = new Student2("Ola", "Nordmann", new DateTime("2000-01-01"), 'math');
$student2 = new Student2("Kari", "Nordmann", new DateTime("1999-02-02"), 'meth');

// Display details of the students
echo 'Student with username: ' . $student1->getUserName() . " is studying " . $student1->getStudyProgram() . "<br>";
echo 'With name: ' . $student1->getFullName() . "<br>";
echo 'Is registered: ' . $student1->getCreatedDate()->format('Y-m-d H:i:s') . "<br><br>";


echo 'Student with username: ' . $student2->getUserName() . " is studying " . $student2->getStudyProgram() . "<br>";
echo 'With name: ' . $student2->getFullName() . "<br>";
echo 'Is registered: ' . $student2->getCreatedDate()->format('Y-m-d H:i:s') . "<br>";


// Delete objects
unset($student1, $student2);

echo '<br>';
echo 'Deleted user names: <br>';
// Display usernames of the deleted users
print_r(User2::showDeletedUsernames());

include '../sharedViewBottom.php';
