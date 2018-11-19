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

    /*
        CREATE TABLE notes ( id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, username VARCHAR(75) NOT NULL, content VARCHAR(200), dateMade VARCHAR(15) )

        insert into notes (username, content, dateMade) values ('root', 'content', 'date place');
    */

    function getUserNotes($db, $user)
    {
        try
        {
            $query = "SELECT * FROM notes WHERE username = :u ;";
            $statement = $db->prepare($query);
            $statement->bindvalue(':u', $user);
            $statement->execute();
            //$statement->closeCursor();
            return $statement->fetchAll();
        }
        catch (PDOException $e)
        {
            $error_message = $e->getMessage();
            echo "<p>Error: $error_message</p>";
            die();
        }
    }
    // UPDATE notes SET content='New Content', dateMade = 'new data' WHERE username = 'jack'
    function updateNote($db, $content, $user, $id)
    {
        try
        {
            $query = "UPDATE notes SET content=:c, dateMade = :d WHERE id = :i;";
            $statement = $db->prepare($query);
           // $statement->bindvalue(':u', $user);
            $statement->bindvalue(':c', $content);
            $statement->bindvalue(':i', $id);
            $statement->bindvalue(':d', date("Y/m/d"));
            $statement->execute();
            $statement->closeCursor();
        }
        catch (PDOException $e)
        {
            $error_message = $e->getMessage();
            echo "<p>Error: $error_message</p>";
            die();
        }
    }

    function newNote($db, $content, $user)
    {
        try
        {
            $query = "INSERT INTO notes (username, content, dateMade) VALUES (:u, :c, :d);";
            $statement = $db->prepare($query);
           // $statement->bindvalue(':u', $user);
            $statement->bindvalue(':c', $content);
            $statement->bindvalue(':u', $user);
            $statement->bindvalue(':d', date("Y/m/d"));
            $statement->execute();
            $statement->closeCursor();
        }
        catch (PDOException $e)
        {
            $error_message = $e->getMessage();
            echo "<p>Error: $error_message</p>";
            die();
        }
    }

    function deleteNote($db, $id)
    {
        try
        {
            $query = "DELETE FROM notes WHERE id = :i;";
            $statement = $db->prepare($query);
            $statement->bindvalue(':i', $id);
            $statement->execute();
            $statement->closeCursor();
        }
        catch (PDOException $e)
        {
            $error_message = $e->getMessage();
            echo "<p>Error: $error_message</p>";
            die();
        }
    }

    // Review code
    /*
        CREATE TABLE notes ( id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, username VARCHAR(75) NOT NULL, content VARCHAR(200), dateMade VARCHAR(15) )

        insert into notes (username, content, dateMade) values ('root', 'content', 'date place');

        CREATE TABLE reviews (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, date VARCHAR(20), designer VARCHAR(75), reviewer VARCHAR(75), url VARCHAR(100), content TEXT, score INT(15), userID VARCHAR(50));

        INSERT INTO reviews (date, designer, reviewer, url, content, score, userID) values ('new date', 'joe', 'matt', 'www.asas.com','a review of the thing', '10', '0');
    */

    function newReview($db, $designer, $reviewer, $url, $content, $score, $userID)
    {
        try
        {
            $query = "INSERT INTO reviews (date, designer, reviewer, url, content, score, userID) values (:d, :ds, :rv, :url, :c, :r, :i);";
            $statement = $db->prepare($query);
            $statement->bindvalue(':d', date("Y/m/d"));
            $statement->bindvalue(':ds', $designer);
            $statement->bindvalue(':rv', $reviewer);
            $statement->bindvalue(':url', $url);
            $statement->bindvalue(':c', $content);
            $statement->bindvalue(':r', $score);
            $statement->bindvalue(':i', $userID);
            
            $statement->execute();
            $statement->closeCursor();
        }
        catch (PDOException $e)
        {
            $error_message = $e->getMessage();
            echo "<p>Error: $error_message</p>";
            die();
        }
    }

    function getUserReviews($db)
    {
        try
        {
            $query = "SELECT * FROM `reviews`;";
            $statement = $db->prepare($query);
            $statement->execute();
            //$statement->closeCursor();
            return $statement->fetchAll();
        }
        catch (PDOException $e)
        {
            $error_message = $e->getMessage();
            echo "<p>Error: $error_message</p>";
            die();
        }
    }
    //  $query = "UPDATE notes SET content=:c, dateMade = :d WHERE id = :i;";
    function editReview($db, $designer, $reviewer, $url, $content, $score, $reviewID)
    {
        try
        {
            $query = "UPDATE reviews SET date=:d, designer=:ds, reviewer = :rv, url = :url, content = :c, score = :r WHERE id = :i;";
            $statement = $db->prepare($query);
            $statement->bindvalue(':d', date("Y/m/d"));
            $statement->bindvalue(':ds', $designer);
            $statement->bindvalue(':rv', $reviewer);
            $statement->bindvalue(':url', $url);
            $statement->bindvalue(':c', $content);
            $statement->bindvalue(':r', $score);
            $statement->bindvalue(':i', $reviewID);
            
            $statement->execute();
            $statement->closeCursor();
        }
        catch (PDOException $e)
        {
            $error_message = $e->getMessage();
            echo "<p>Error: $error_message</p>";
            die();
        }
    }



?>
