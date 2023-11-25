<?php
include '../sharedViewTop.php';
include 'Student.php';

$student = new Student('Harry', 'Potter', 'HarryPot', new DateTime('2000-01-01'), 'Wizardry');

echo $student->getFullName() . ' is studying ' . $student->getStudyProgram();
echo '<br>';
echo '<br>';


echo 'Here is the whole object: <br>';
print "<pre>";
print_r($student);
print "</pre>";

include '../sharedViewBottom.php';
