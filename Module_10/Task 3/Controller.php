<?php
include '../sharedViewTop.php';

// Set the latitude and longitude
$latitude = 58.1643244;
$longitude = 7.998648;

// Define the base URL for the map
$base_url = 'https://www.openstreetmap.org/export/embed.html';

// Calculate the bounding box coordinates
$delta = 0.01;
$bboxLeft = $longitude - $delta;
$bboxBottom = $latitude - $delta;
$bboxRight = $longitude + $delta;
$bboxTop = $latitude + $delta;

// Assemble the bounding box parameter
$bboxParam = implode(",", [$bboxLeft, $bboxBottom, $bboxRight, $bboxTop]);

// Construct the full map URL with parameters
$map_url = "$base_url?bbox=$bboxParam&layer=mapnik&marker=$latitude,$longitude";

// Generate the iframe for embedding the map
echo '<iframe width="600" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="'
    . $map_url . '">

</iframe>';

include '../sharedViewBottom.php';
