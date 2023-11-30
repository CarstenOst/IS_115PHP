<?php
include '../sharedViewTop.php';
echo '<h4> You can try to upload the 123.png in this folder </h4>';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['profileImage'])) {
    $file = $_FILES['profileImage'];
    $userId = '123'; // The primary key of the user in the "database"
    $uploadDir = '../Task 3/';
    $allowedTypes = ['image/jpeg', 'image/png'];
    $maxSize = 2 * 1024 * 1024; // 2MB

    if (!in_array($file['type'], $allowedTypes)) {
        echo "Only JPG and PNG files are allowed.";
    } elseif ($file['size'] > $maxSize) {
        echo "It's too big!"; // That's not what she said
    } else {
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $targetFile = $uploadDir . $userId . '.' . $extension;
        if (move_uploaded_file($file['tmp_name'], $targetFile)) {
            echo "File was uploaded successfully.";
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
