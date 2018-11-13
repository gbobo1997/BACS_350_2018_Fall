<?php 

	session_start();
	require_once 'db.php';

	$id = filter_input(INPUT_POST, 'ID');

	deleteNote(connect(), $id);
	header("Location: index.php");
?>