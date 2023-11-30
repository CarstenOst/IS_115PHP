<?php
include '../sharedViewTop.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['profileImage'])) {
    $file = $_FILES['profileImage'];
    $userId = '420'; // The primary key of the user in the "database"
    $uploadDir = '../Task 3/';
    $allowedTypes = ['image/jpeg', 'image/png'];
    $maxSize = 2 * 1024 * 1024; // 2MB

    if (!in_array($file['type'], $allowedTypes)) {
        echo "Only jpeg and png files are allowed.";
    } elseif ($file['size'] > $maxSize) {
        echo "It's too big!";
    } else {
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $targetFile = $uploadDir . $userId . '.' . $extension;
        if (move_uploaded_file($file['tmp_name'], $targetFile)) {
            echo "Image was uploaded successfully.";
            if (file_exists("$userId.png")) {
                echo "<img src='$userId.png' width='100' height='100'>";
            } else {
                echo "<img src='$userId.jpeg' width='100' height='100'>";
            }
        } else {
            echo "There was an error uploading the file.";
        }
    }
}
?>

    <form action="" method="post" enctype="multipart/form-data">
        Choose an image to upload:
        <input type="file" name="profileImage" id="profileImage"><br>
        <input type="submit" value="Upload image" name="submit">
    </form>

<?php
include '../sharedViewBottom.php';
