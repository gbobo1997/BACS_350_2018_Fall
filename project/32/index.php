<?php
    
    require_once 'log.php';
    require_once 'views.php';
    require_once 'auth.php';


    // Log the page load
    $log->log_page();

	// display page content
    $content .= render_button('Show Log', 'pagelog.php');
    $content .= render_button('Login', 'index.php?action=login');
    $content .= render_button('Sign Up', 'index.php?action=signup');


    $content .= $auth->handle_actions();

    // Create main part of page content
    $settings = array(
        "site_title" => "System Admins",
        "page_title" => "User Authentication", 
        "logo"       => "Bear.png",
        "style"      => 'style.css',
        "content"    => $content);

    echo render_page($settings);

?>
