<?php

    // Add a new record
    function add_album($db, $album, $artist, $artworkLink, $purchaseLink, $description, $review) {

        // Show if insert is successful or not
        try {

            // Add database row
            $query = "INSERT INTO Albums (artist, name, artwork, purchaseURL, description, review) VALUES (:artist, :album, :artworkLink, :purchaseLink, :description, :review);";
            $statement = $db->prepare($query);
            $statement->bindValue(':artist', $artist);
            $statement->bindValue(':album', $album);            
            $statement->bindValue(':artworkLink', $artworkLink);
            $statement->bindValue(':purchaseLink', $purchaseLink);
            $statement->bindValue(':description', $description);
            $statement->bindValue(':review', $review);
            $statement->execute();
            $statement->closeCursor();
            return true;
             
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Error: $error_message</p>";
            die();
        }
        
    }


    // Delete all database rows
    function clear_albums($db) {
        
        try {
            $query = "DELETE FROM Albums";
            $statement = $db->prepare($query);
            $row_count = $statement->execute();
            return true;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Error: $error_message</p>";
            die();
        }
        
    }


    // Query for all subscribers
    function query_albums ($db) {

        $query = "SELECT * FROM Albums";
        $statement = $db->prepare($query);
        $statement->execute();
        return $statement->fetchAll();

    }

?>
