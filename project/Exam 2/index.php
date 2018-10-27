<?php
    // Start the page
    require_once 'views.php';
    require_once 'album.php';
    require_once 'db.php';
 
    $site_title = 'RCarver BACS350';
    $page_title = 'Exam 2 - Music Manager';
    begin_page($site_title, $page_title);
    // Page Content
    // Log the page load
    require_once 'log.php';
    //$log->log_page("exam2/index.php");
    // Page Content
   // Create a new album object
    $album = new album;
    render_album($album->query());
    end_page();
?>

