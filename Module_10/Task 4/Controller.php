<?php
include '../sharedViewTop.php';
$host = "localhost";
$dbname = "your_database";
$user = "your_username";
$pass = "your_password";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
} catch (PDOException $e) {
    die("Could not connect to the database: " . $e->getMessage());
}

// Handle file upload
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['userfile'])) {
    $filename = $_FILES['userfile']['tmp_name'];

    if (($handle = fopen($filename, "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $username = $data[0];
            $email = $data[1];

            // Generate a temporary password
            $tempPassword = bin2hex(random_bytes(4)); // Simple 8-character hex password

            // Insert into database (use prepared statements to prevent SQL injection)
            $stmt = $pdo->prepare("INSERT INTO User (username, email, password) VALUES (:username, :email, :password)");
            $stmt->execute(['username' => $username, 'email' => $email, 'password' => password_hash($tempPassword, PASSWORD_DEFAULT)]);
        }
        fclose($handle);
    }
}
?>

<form enctype="multipart/form-data" action="" method="POST">
    <input type="file" name="userfile" />
    <input type="submit" value="Upload" />
</form>

