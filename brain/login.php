<?php 
	session_start();

	/* todo
		- brain/index.php should contain links to each app which should reside at notes.php etc.,
		  should I share files between eachother? probably not, lets use brain/notes/index.php

		- move a ?button? into the header next to icon that redirects user
		  to the login page if login session cookie is not set. Session cookie
		  will be unique identifier associated with save notes. Login: (user or none) <button>Login</button> changes to logout if logged in

		- saved notes will be displayed in an ?object? format view via stacked cards
		  or a quad of cards. 

		- each card will have edit/delete functionality 

		- user must be logged in to access/create notes
	*/
	require_once 'login_view.php';
	require_once 'login_logic.php';
	require_once 'db.php';
 	
    $site_title = 'App 6';
    $page_title = 'Login';
    begin_page($site_title, $page_title);

    isLoggedIn(connect(), false);   
?>