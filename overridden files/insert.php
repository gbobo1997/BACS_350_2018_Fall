<?php
     class Note
     {
     	function Note($title_, $body_)
     	{
     		$this->title = $title_;
     		$this->body = $body_;
     		$this->date = date("Y/m/d");
     	}
     }

     // Pick out the inputs
    $passed_title = filter_input(INPUT_POST, 'my_title');
    $passed_body = filter_input(INPUT_POST, 'my_content');
    $success ='index.php';

    $newNote = new Note($passed_title, $passed_body);

    // Connect to the database
    require_once 'db.php';
    $db = remote_connect();   

    // Add record
    add_note ($newNote, $success, $db);
?>