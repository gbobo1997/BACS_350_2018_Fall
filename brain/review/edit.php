<?php 
	session_start();
	require_once 'db.php';

	$user = $_SESSION['user_id'];
	$designer = filter_input(INPUT_POST, 'designer');
	$reviewer = filter_input(INPUT_POST, 'reviewer');
	$url = filter_input(INPUT_POST, 'url');
	$score = filter_input(INPUT_POST, 'score');
	$content = filter_input(INPUT_POST, 'newContent');

	$choice = filter_input(INPUT_POST, 'choice');

	$id = filter_input(INPUT_POST, 'ID');

	// if it is a new note the ID is user_ID
	// if it is an edit the ID is the review ID
	// 0 -> edit
	// 1 -> new
	if($choice == 0)
	{
		// $db, $designer, $reviewer, $url, $content, $score, $postID
		editReview(connect(), $designer, $reviewer, $url, $content, $score, $id);
	}
	else
	{
		// $db, $designer, $reviewer, $url, $content, $score, $userID
		newReview(connect(), $designer, $reviewer, $url, $content, $score, $user);
	}
	
	header("Location: index.php");
	// need to get the edit posts tro showup, id is not matching
	// properly on new notes, it is setting to 0
?>