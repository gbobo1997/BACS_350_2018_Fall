<?php 
	require_once 'db.php';

	function listNotes($db)
	{
		if ( isset( $_SESSION['user_id'] ) ) 
		{
			$list = getUserNotes($db, $_SESSION['user_id']);
			//echo $_SESSION['user_id'];
			//echo count($list);
			writeNotes($list);
		} 
		else 
		{
			echo 'Please Log In';
		}
	}
?>