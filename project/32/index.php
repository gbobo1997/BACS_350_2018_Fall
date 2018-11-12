<?php 
	session_start();


	require_once 'login_view.php';
	require_once 'login_logic.php';
	require_once 'db.php';
 	
    $site_title = 'App 6';
    $page_title = 'Login';
    begin_page($site_title, $page_title);

    isLoggedIn(connect());
    


?>