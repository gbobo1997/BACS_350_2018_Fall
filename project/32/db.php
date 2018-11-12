<?php

/* --------------------------------------      

SQL for Table

CREATE TABLE users (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
username VARCHAR(75) NOT NULL, 
password VARCHAR(100) NOT NULL
);

insert into users (username, password) VALUES ('A', 'X')
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
        $username = 'root';
        $password = '';
        $db_connect = "mysql:host=$host;dbname=$dbname";
        //echo 'local connect';
        return db_connect($db_connect, $username, $password);

    }


    // Open the database or die
    function db_connect($db_connect, $username, $password) 
    {
        try 
        {
            $db = new PDO($db_connect, $username, $password);
            //echo 'Succesful db conection';
            return $db;
        } 
        catch (PDOException $e) 
        {
            $error_message = $e->getMessage();
            echo "<p>Error: $error_message</p>";
            die();
        }

    }


    // Open the database or die
    function connect() 
    {
        
        $local = ($_SERVER['SERVER_NAME'] == 'localhost');
        if ($local) 
        {
            return local_connect();
        } 
        else 
        {
            return remote_connect();
        }
        
    }

    // Insert a new user into the database
    function insertUser($username, $password, $db)
    {
        try 
        {
            $query = "INSERT INTO users (username, password) VALUES (:u, :p);";
            $statement = $db->prepare($query);
            $statement->bindvalue(':u', $username);
            $statement->bindvalue(':p', $password);
            $statement->execute();
            $statement->closeCursor();
            //echo "Insert Success: </br> $username </br> $password";
            return true;
        }
        catch (PDOException $e)
        {
            $error_message = $e->getMessage();
            echo "<p>Error: $error_message</p>";
            die();
        }
    }

?>
