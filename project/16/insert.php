<?php
     // Pick out the inputs
    $name = filter_input(INPUT_POST, 'my_name');
    $email = filter_input(INPUT_POST, 'my_email', FILTER_VALIDATE_EMAIL);
    $success ='index.php';

    // Connect to the database
    require_once 'db.php';
    $db = remote_connect();   

    // Add record
    add_subscriber ($db, $name, $email, 'index.php');
?>