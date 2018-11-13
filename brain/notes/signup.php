<?php 
	session_start();


	require_once 'login_view.php';
	require_once 'login_logic.php';
	require_once 'db.php';
 	

	signupListener(connect());
	echo 'Signup successful! <br>';
	echo "<br><a href='index.php'>Return and log in</a>";

?>