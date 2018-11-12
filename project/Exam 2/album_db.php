<?php

/* --------------------------------------      

SQL for Table

CREATE TABLE Albums (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
artist VARCHAR(50) NOT NULL,
name VARCHAR(100) NOT NULL,
artwork VARCHAR(500),
purchaseURL VARCHAR(500),
description VARCHAR(1000), 
review VARCHAR(1000)    
);

INSERT INTO albums (artist, name, artwork, purchaseURL, description, review)
VALUES ('Savant', 'Slasher', 'https://f4.bcbits.com/img/a2758189808_16.jpg', 'https://savantofficial.bandcamp.com/album/slasher', ' A Halloween soundtrack album', 'Pretty good');

CREATE TABLE log (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
date VARCHAR(50),
EVENT VARCHAR(100));
-------------------------------------- */

    // Connect to the remote database
    function remote_connect() {

        $port = '3306';
        $dbname = 'pvwwprmy_bacs350_general';
        $db_connect = "mysql:host=localhost:$port;dbname=$dbname";
        $username = 'pvwwprmy_350DB';
        $password = 'DBTest';
        return db_connect($db_connect, $username, $password);

    }


    // Local Host Database settings
    function local_connect() {

        $host = 'localhost';
        $dbname = 'pvwwprmy_bacs350_general';
        $username = 'pvwwprmy_350DB';
        $password = 'DBTest';
        $db_connect = "mysql:host=$host;dbname=$dbname";
        return db_connect($db_connect, $username, $password);

    }


    // Open the database or die
    function db_connect($db_connect, $username, $password) 
    {
        
//        echo "<h2>DB Connection</h2><p>Connect String:  $db_connect, $username, $password</p>";
        try {
            $db = new PDO($db_connect, $username, $password);
         echo '<p><b>Successful Connection</b></p>';
            return $db;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Error: $error_message</p>";
            die();
        }

    }


    // Open the database or die
    function connect() {
        
        $local = ($_SERVER['SERVER_NAME'] == 'localhost');
        if ($local) {
            return local_connect();
        } 
        else {
            return remote_connect();
        }
        
    }

?>
