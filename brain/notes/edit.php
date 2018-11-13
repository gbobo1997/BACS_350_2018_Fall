<?php 
	session_start();
	require_once 'db.php';

	$user = $_SESSION['user_id'];
	$content = filter_input(INPUT_POST, 'newContent');
	$id = filter_input(INPUT_POST, 'ID');

	//echo $id;
	if($id == 'new')
	{
		newNote(connect(), $content, $user);
	}
	else
	{
		updateNote(connect(), $content, $user, $id);
	}
	
	header("Location: index.php");
?>