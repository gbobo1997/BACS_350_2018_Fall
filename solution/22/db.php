<?php

    /* -------------------------------
        DB CONNECT
    ------------------------------- */

    // Connect to the remote database
    function remote_connect() {

        // Form the DB Connection string
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
        $dbname = 'subscribers';
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
            // echo '<p><b>Successful Connection</b></p>';
            return $db;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Error: $error_message</p>";
            die();
        }

    }


    // Open the database or die
    function subscribers_connect() {
        
        $remote = ($_SERVER['SERVER_NAME'] == 'unco-bacs.org');
        if ($remote) {
            return remote_connect();
        } 
        else {
            return local_connect();
        }
        
    }


    /* -------------------------------
        CRUD OPERATIONS
    ------------------------------- */


    // Add a new record
    function add_note($obj, $success, $db) {

        // Show if insert is successful or not
        try {

            // Add database row
            $query = "INSERT INTO notes (title, date, body) VALUES (:title, :date, :body);";
            $statement = $db->prepare($query);
            $statement->bindValue(':title', $obj->title);
            $statement->bindValue(':date', $obj->date);
            $statement->bindValue(':date', $obj->body);
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


    // Query for all subscribers
    function query_notes ($db) {

        $query = "SELECT * FROM notes";
        $statement = $db->prepare($query);
        $statement->execute();
        return $statement->fetchAll();

    }

?>
