<?php
    // Connect to the database
    require_once 'db.php';
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