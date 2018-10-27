<?php

    // Start the page
    require_once 'views.php';
 
    $site_title = 'BACS 350 - Exam 2';
    $page_title = 'View/Add Albums';
    begin_page($site_title, $page_title);

    echo '<p><a href="pagelog.php">Page Log</a></p>';
    
    // import album code
    require_once 'album.php';
    

    // import log code
    require_once 'log.php';
    
    $log->log_page("project/exam2/index.php");


    // Add record from form
    $albums->handle_actions();


    // Render a list of albums
    $albums->show_albums();


    // Show the add form
    $albums->add_form();


    // Clear the list by sending "action" of "clear" to this view
    echo '<p><a href="index.php?action=clear" class="btn">Clear Log</a></p>';


    end_page();
?>
