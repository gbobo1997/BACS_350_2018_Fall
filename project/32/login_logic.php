<?php 
	require_once 'login_view.php';
	require_once 'db.php';
	function isLoggedIn($db)
	{
		if ( isset( $_SESSION['user_id'] ) ) 
		{
			logoutUI();
		} 
		else 
		{
			echo 'Please Log In';
			login_form();
			loginListener($db);
		}
	}

	function loginListener($db)
	{
		//echo 'Login Listener';
		
		$username = filter_input(INPUT_POST, 'username');
		$password = filter_input(INPUT_POST, 'password');
		// Fetch the password hash from db based on username
		// validate the password hashes match

		// For testing hashes
		
		if( password_verify($password, getHash($username, $db)[0]))
		{
			$_SESSION['user_id'] = 123;
			sleep(1);
			header("Location: index.php");
		}

		// for direct string testing
		/*
		if($password == 'test')
		{
			$_SESSION['user_id'] = 123;
			echo 'login success';
			header("Location: index.php");
		}*/
	}

	function signupListener($db)
	{
		//echo 'Signup Listener';
		
		$username = filter_input(INPUT_POST, 'username');
		$password = filter_input(INPUT_POST, 'password');

		$hash = password_hash($password, PASSWORD_DEFAULT);

		insertUser($username, $hash, $db);
	}

	function getHash($u, $db)
	{
		$query = "SELECT password FROM users WHERE username = :u;";
		$statement = $db->prepare($query);
		$statement->bindvalue(':u', $u);
		$statement->execute();
		return $statement->fetch();
	}

?>