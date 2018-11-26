<?php 
require_once 'view.php';
$title = "Data Lookup";
$pageName = "BACS485 Front End";
begin_page($title, $pageName);

$student = filter_input(INPUT_POST, 'studentID');

// Form the DB Connection string
    $port = '3306';
    $dbname = 'pvwwprmy_bacs350_books';
    $db_connect = "mysql:host=localhost:$port;dbname=$dbname";
    $username = 'pvwwprmy_350DB';
    $password = 'DBTest';


    // Open the database or die
    try {
        $db = new PDO($db_connect, $username, $password);
        echo '<p><b>Successful Connection</b></p>';
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        echo "<p>Error: $error_message</p>";
    }

    try 
        {
            $query = "SELECT * FROM student WHERE studentID = :i;";
            $statement = $db->prepare($query);
            $statement->bindvalue(':i', $student);
            $statement->execute();
            $list = $statement->fetchAll();
            $statement->closeCursor();
            //echo "Insert Success: </br> $username </br> $password";
        }
        catch (PDOException $e)
        {
            $error_message = $e->getMessage();
            echo "<p>Error: $error_message</p>";
            die();
        }

    foreach($list as $s)
    {
    	echo'First Name: '.$s['firstName'].'<br>';
    	echo'Last Name: '.$s['lastName'].'<br>';
    	echo'Grade Year: '.$s['grade_year'].'<br>';
    	echo'Student ID: '.$s['studentID'].'<br>';

    }
?>