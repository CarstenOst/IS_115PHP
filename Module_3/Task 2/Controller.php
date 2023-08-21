<?php
// Without a for loop*******
include 'Counter.php';
// This will echo
session_start();

if (isset($_POST['reset'])) {
    $_SESSION['count'] = -1;
    $_SESSION['sum'] = 0;
}
// If count is not set, then sum is not set either
if (!isset($_SESSION['count'])) {
    $_SESSION['count'] = 0;
    $_SESSION['sum'] = 0;
} else {
    $_SESSION['sum'] += ++$_SESSION['count'];
}
include '../sharedViewTop.php';
echo $_SESSION['count'] . ' seconds <br>';
echo 'The total sum is: ' . $_SESSION['sum'] . '<br>';
if ($_SESSION['count'] < 9) {
    header("refresh:1");
    return;
}
// echo 'You can keep pressing \'task 2\' to get higher numbers';
// echo '<p>You better hide!</p>'
?>
    <form method="post">
        <input type="submit" name="reset" value="Reset">
    </form>

<?php
Counter::count(9);