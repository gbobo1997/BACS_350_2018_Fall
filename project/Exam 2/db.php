<?php

    /* -------------------------------
        DB CONNECT
    ------------------------------- */

    // Connect to the remote database
    function remote_connect() {

        // Form the DB Connection string
        $port = '3306';
        $dbname = 'pvwwprmy_bacs350_subscribers';
        $db_connect = "mysql:host=localhost:$port;dbname=$dbname";
        $username = 'pvwwprmy_350DB';
        $password = 'DBTest';
        return db_connect($db_connect, $username, $password);

    }

    function album_connect()
    {
        //remote_connect();
        local_connect();
    }


    // Local Host Database settings
    function local_connect() {

        $host = 'localhost';
        $dbname = 'testdb';
        $username = 'root';
        $password = '';
        $db_connect = "mysql:host=$host;dbname=$dbname";
        return db_connect($db_connect, $username, $password);

    }


    // Open the database or die
    function db_connect($db_connect, $username, $password) {
        
        // echo "<h2>DB Connection</h2><p>Connect String:  $db_connect, $username, $password</p>";
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


    /* -------------------------------
        CRUD OPERATIONS
    ------------------------------- */


    // Delete all database rows
    function clear_subscribers($db, $success) {
        
        try {
            $query = "DELETE FROM subscribers";
            $statement = $db->prepare($query);
            $row_count = $statement->execute();
//            echo '<p><b>Delete successful</b></p>';
            return true;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Error: $error_message</p>";
            die();
        }
        
    }


    // Query for all albums
    function query_albums($db) 
    {

        $test = album_connect();
        $query = "SELECT * FROM albums";
        $statement = $test->prepare($query);
        $statement->execute();
        return $statement->fetchAll();
    }

      // Add a new album
    function add_album($db, $artist, $name, $artwork, $purchase_url, $description, $review, $success) {

        // Show if insert is successful or not
        try {

            // Add database row
            $query = "INSERT INTO albums (artist, name, artwork, purchaseURL, description, review) VALUES(artist:, name:. artwork:, purchase_url:, description:, review:); ";

            $statement = $db->prepare($query);
            $statement -> bindValue(':artist', $artist);
            $statement->bindValue(':name', $name);
            $statement->bindValue(':artwork', $artwork);
            $statement->bindValue(':purchase_url', $purchase_url);
            $statement->bindValue(':description', $description);
            $statement->bindValue(':review', $review);
            $statement->execute();
            $statement->closeCursor();

            header("Location: $success");
            //echo '<p><b>Insert successful</b></p>';

        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Error: $error_message</p>";
            die();
        }
        
    }

?>
