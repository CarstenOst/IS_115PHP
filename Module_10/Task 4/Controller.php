<?php
include '../sharedViewTop.php';

$host = "localhost";
$dbname = "mod10";
$user = "root";
$pass = "123";

//POD = PHP Data Object (connect to the database)
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
} catch (PDOException $e) {
    die("Could not connect to the database: " . $e->getMessage());
}

// Handle file upload
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['csv-file'])) {
    $filename = $_FILES['csv-file']['tmp_name'];
    if (!file_exists($filename) || !is_readable($filename)) {
        die("File does not exist or is not readable");
    }

    if (($handle = fopen($filename, "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $firstName = $data[0];
            $lastName = $data[1];
            $email = $data[2];
            $userType = $data[3]; // Assuming userType is the fourth column in the CSV

            // Create a temporary password based on user information
            $tempPassword = substr($firstName, 0, 2) . substr($lastName, 0, 2) . substr($email, 0, 2);
            $hashedPassword = password_hash($tempPassword, PASSWORD_DEFAULT);

            // Insert into database (use prepared statements to prevent SQL injection)
            $stmt = $pdo->prepare("
                INSERT INTO User 
                    (firstName, lastName, email, password, userType) 
                VALUES 
                    (:firstName, :lastName, :email, :password, :userType)");

            $stmt->execute([
                'firstName' => $firstName,
                'lastName' => $lastName,
                'email' => $email,
                'password' => $hashedPassword,
                'userType' => $userType
            ]);
            echo "Users successfully inserted: $firstName $lastName with temporary password $tempPassword <br>";
        }
        fclose($handle);
    }
}
?>

<form method="post" enctype="multipart/form-data">
    <input type="file" name="csv-file" accept=".csv">
    <input type="submit" name="submit" value="Upload">
</form>

