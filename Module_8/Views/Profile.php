<?php

namespace Views;

require("../autoloader.php");

use Validators\Auth;
use Validators\SessionConst;

if (!Auth::isLoggedIn()) {// Starts session, and checks if user is logged in. If not, redirects to login page
    header("Location: ./Login.php?response[]=You are not logged in!&response[]=0");
    exit();
}

class Profile
{
    /**
     * View the user profile if the user is logged-in
     * Session must be set!
     *
     * @return void echos the user profile
     */
    public static function viewUserProfile(): void
    {
        $firstName = $_SESSION[SessionConst::FIRST_NAME];
        $lastName = $_SESSION[SessionConst::LAST_NAME];
        $userType = $_SESSION[SessionConst::USER_TYPE];
        $email = $_SESSION[SessionConst::EMAIL];
        $about = $_SESSION[SessionConst::ABOUT];
        echo "
            <div class='user-profile'>
                <p>$firstName $lastName</p>
                <p>Email: $email</p>
                <p>Role: $userType</p>
                <p>Bio: $about</p>
            </div>
        ";
    }
}


// TODO remove this
//SessionConst::sessionDebugger();
?>

<head lang="en">
    <script src="https://kit.fontawesome.com/5928831ae4.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../Assets/style.css">
    <title>Profile</title>
</head>

<body>
<div class="side-menu">
    <ul>
        <li>
            <a class="logo-title" href="#">
                MentorMate
            </a>
        </li>
        <li>
            <a href="Profile.php" class="side-menu-profile-link">
                <div class="profile">
                    <i class="profile-icon fa-solid fa-user"></i>
                    <p>Profile</p>
                </div>
            </a>
        </li>
        <li><a href="SecureFile.php">Secure Page</a></li>
        <li><a href="StudentsOnly.php">Students Only!</a></li>
        <li><a href="TutorsOnly.php">Tutors Only!</a></li>
        <li><a href="../inc/Logout.php">Log Out</a></li>
    </ul>
</div>

<div class="main-view">
<?php
    Profile::viewUserProfile();
?>
</div>
