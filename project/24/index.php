<?php
    // Start the page
    require_once 'views.php';
 
    $site_title = 'RCarver BACS350';
    $page_title = 'Project 24 - Page Templates';
    begin_page($site_title, $page_title);
    // Page Content
    echo '<p><a href="..">Solutions</a></p>';
    echo '<p><a href="pagelog.php">Page Log</a></p>';
    echo '<p><a href="example.php">Example of Page Template</a></p>';
    // Log the page load
    require_once 'log.php';
    $log->log_page("solution/24/index.php");
    // Page Content
    include 'demo-steps.php';
    render_page_content();
    end_page();
?>