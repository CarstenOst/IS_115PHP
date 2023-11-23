<?php
include '../sharedViewTop.php';

include 'User.php';

$user = new User("Lars", "Monsen", "LarsMon", new DateTime("1963-04-21"));

echo $user->getFullName() . ' is ' . $user->getAge() . ' years old';

echo '<br>';
echo '<br>';

echo 'Here is the whole object: <br>';
print "<pre>";
print_r($user);
print "</pre>";

include '../sharedViewBottom.php';
