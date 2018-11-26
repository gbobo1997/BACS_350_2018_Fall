<?php 

require_once 'view.php';
$title = "BACS485 Final";
$pageName = "BACS485 Front End";
begin_page($title, $pageName);

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
	// take student id lookup

    echo '
    <form action="lookup.php" method="post"> Student ID: <input type="text" name="studentID"><br>
    <input type="submit" value="Submit"> </form>';
    echo '<br><br> Links to images of schema: <a href="images.php">here</a>';
 end_page();
?>