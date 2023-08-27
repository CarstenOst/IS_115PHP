<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../styles.css">
    <title>Module 3</title>
</head>
<body>
<div class="container d-flex justify-content-center align-items-center">
    <div class="flex-column justify-content-center">
        <div class="flex-column justify-content-center">
            <div class="d-flex justify-content-center fixed-top">
                <nav id="navbar" class="d-flex navbar navbar-expand-lg">
                    <?php require_once 'sharedFunctions.php';sharedFunctionsM4::generateNavigationButtons('Module_4');?>
                </nav>
            </div>
            <div id="" class="flex-column justify-content-center text-center container">
                <h1>
                    <?php sharedFunctionsm4::generateParentFolderName();?>
                </h1>
