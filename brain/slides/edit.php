<?php 
	session_start();
	require_once 'db.php';

	$user = $_SESSION['user_id'];

	$choice = filter_input(INPUT_POST, 'choice');

	// if it is a new note the ID is user_ID
	// if it is an edit the ID is the review ID
	// 0 -> edit
	// 1 -> new
	if($choice == 0)
	{
		// Dont need to edit the database as the content
		// is stored within files, the reference stays the same
		$content = filter_input(INPUT_POST, 'newContent');
		$source = filter_input((INPUT_POST), 'source');
		$slides = 'slides/'.$source;
		$file = fopen($slides, "w") or die ("Unable to open file");
		fwrite($file, $content);
		fclose($myfile);
	}
	else
	{
		$content = filter_input(INPUT_POST, 'newContent');
		$name = filter_input((INPUT_POST), 'name');
		$slides = 'slides/'.$name;
		$file = fopen($slides, "w") or die ("Unable to open file");
		fwrite($file, $content);
		fclose($myfile);
		// new presentation
		// $db, $designer, $reviewer, $url, $content, $score, $userID
		newPresentation(connect(), $name, $user);
	}
	header("Location: index.php");
	// need to get the edit posts tro showup, id is not matching
	// properly on new notes, it is setting to 0
?>