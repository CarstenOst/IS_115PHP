<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/5928831ae4.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="../styles.css">
    <title> <?php require_once 'sharedFunctionsM7.php'; echo sharedFunctionsM7::getCurrentModuleFolderName() ?> </title>
</head>
<body>
<div class="container d-flex justify-content-center">
    <div class="flex-column">
        <div class="d-flex justify-content-center fixed-top">
            <nav id="navbar" class="d-flex navbar navbar-expand-lg">
                <?php sharedFunctionsM7::generateNavigationButtons(); ?>
            </nav>
        </div>
        <div id="messageContainer" class="d-flex flex-column align-items-center">
        </div>
        <div id="" class="flex-column justify-content-center text-center container" style="padding-top: 65px">
            <h2>
                <?php echo sharedFunctionsM7::generateParentFolderName(); ?>
            </h2>
