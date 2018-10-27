<?php

    // Connect to the database
    require_once 'album.php';
    require_once 'log.php';
    $log->log_page("project/exam2/index.php");

    // Pick out the inputs
    $album  = filter_input(INPUT_POST, 'album');
    $artist = filter_input(INPUT_POST, 'artist');
    $artworkLink = filter_input(INPUT_POST, 'artworkLink');
    $purchaseLink = filter_input(INPUT_POST, 'purchaseLink');
    $description = filter_input(INPUT_POST, 'description');
    $review = filter_input(INPUT_POST, 'review');

    // Add record
    if ($albums->add ($album, $artist, $artworkLink, $purchaseLink, $description, $review)) {
        header("Location: index.php");
    }

?>
