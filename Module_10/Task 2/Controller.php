<?php
include '../sharedViewTop.php';
include '../ConstantsM10.php';

// The newsletter (tasty salomon)
$message = '
<html lang="en">
<head>
  <title>Your Tasty Smoked Salmon!</title>
</head>
<body>
  <img src="https://i.imgur.com/a27N0Hm.png" alt="Logo" width="200">
  <p>We have very tasty naturally bred salmon!</p>
  <a href="https://kingmikal.no/en/product/juniper-smoked-salmon-whole/">Smoked salmon whole!</a> <br>
  <a href="https://kingmikal.no/en/product/gift-box-with-1-piece-of-salmon-approx-300-g-2/">In need of a gift for x-mas?</a>
  
  <footer>
    <p>TrueSalomon is a company that cares about the environment!</p>
  </footer>
</body>
</html>
';


function sendMail(array $formData): void
{
    // Make sure the email is a valid email
    $email = filter_var($formData[EMAIL_RECIPIENT], FILTER_SANITIZE_EMAIL);
    $subject = $formData[SUBJECT];
    $message = $formData[MESSAGE];

    $headers = [
        "Content-Type: application/json",
        "Authorization: Bearer re_5cE4VGtu_BqoJshHEYe8ThdMb1u4t9FFR", // This Bearer is revoked :)
    ];


    $data = [
        "from" => "onboarding@resend.dev",
        "to" => $email,
        "subject" => $subject,
        "html" => $message . "<br> Best wishes, <br>{$formData[NAME]}",
    ];

    // Create context options with headers for the API request
    $api_options = [
        "http" => [
            "method" => "POST",
            "header" => implode("\r\n", $headers),
            "content" => json_encode($data),
        ],
    ];

    // Create a stream context for the API request
    $api_context = stream_context_create($api_options);

    // Send the API POST request and get the response
    $api_response = file_get_contents("https://api.resend.com/emails", false, $api_context);

    if ($api_response !== false) {
        echo "Email sent successfully.";
    } else {
        echo "Email was not sent.";
    }
}


// If the user submits the form, we first sanitize the input, and then store it in an associative array
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $formData = [
        NAME => 'Ole Gunnar',
        EMAIL_RECIPIENT => 'aquulsmurf@gmail.com',
        SUBJECT => 'News letter from TrueSalmon',
        MESSAGE => $message
    ];

    sendMail($formData);
    echo '<br>';
    echo $message;

} else {
    echo <<<html
    <form action="Controller.php" method="post">
        <input type="hidden" name="data" value="Your Data To Post">
        <button type="submit">Post news-letter</button>
    </form>
    html;
}


include '../sharedViewBottom.php';
