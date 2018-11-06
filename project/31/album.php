<?php

    // Create a database connection
    require_once 'album_db.php';
    require_once 'log.php';

    $page = 'index.php';


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

    // Show form for adding a record
    function add_album_view() {
        global $page;
        echo '
        <div class="card">
            <h3>Add Albums</h3>
        
            <form action="index.php" method="post">
                <p><label>Album:</label> &nbsp; <input type="text" name="album"></p>
                <p><label>Artist:</label> &nbsp; <input type="text" name="artist"></p>
                <p><label>Artwork Link:</label> &nbsp; <input type="text" name="artworkLink"></p>
                <p><label>Purchase Link:</label> &nbsp; <input type="text" name="purchaseLink"></p>
                <p><label>Description:</label> &nbsp; <input type="text" name="description"></p>
                <p><label>Review:</label> &nbsp; <input type="text" name="review"></p>
                <p><input type="submit" value="Record"/></p>
                <input type="hidden" name="action" value="create">
            </form>
        </div>
        ';
    }


    // Delete Database Record
    function delete_album($db, $id) {
        $action = filter_input(INPUT_GET, 'action');
        $id = filter_input(INPUT_GET, 'id');
        if ($action == 'delete' and !empty($id)) {
            $query = "DELETE from Albums WHERE id = :id";
            $statement = $db->prepare($query);
            $statement->bindValue(':id', $id);
            $statement->execute();
            $statement->closeCursor();
        }
        global $page;
        header("Location: $page");
    }
    

    // Show form for adding a record
    function edit_album_view($record) {
        $id    = $record['id'];
        $album  = $record['album'];
        $artist = $record['artist'];
        $artworkLink = $record['artworkLink'];
        $purchaseLink = $record['purchaseLink'];
        $description = $record['description'];
        $review = $record['review'];
        global $page;
        echo '
            <div class="card">
                <h3>Edit album</h3>
                <form action="' . $page . '" method="post">
                    <p><label>Album:</label> &nbsp; <input type="text" name="album" value="' . $album . '"></p>
                    <p><label>Artist:</label> &nbsp; <input type="text" name="artist" value="' . $artist . '"></p>
                    <p><label>Artwork Link:</label> &nbsp; <input type="text" name="artworkLink" value="' . $artworkLink . '"></p>
                    <p><label>Purchase Link:</label> &nbsp; <input type="text" name="purchaseLink" value="' . $purchaseLink . '"></p>
                    <p><label>Description:</label> &nbsp; <input type="text" name="description" value="' . $description . '"></p>
                    <p><label>Review:</label> &nbsp; <input type="text" name="review" value="' . $review . '"></p>
                    <p><input type="submit" value="Save Record"/></p>
                    <input type="hidden" name="action" value="update">
                    <input type="hidden" name="id" value="' . $id . '">
                </form>
            </div>
        ';
    }


    // Lookup Record using ID
    function get_album($db, $id) {
        $query = "SELECT * FROM Albums WHERE id = :id";
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $id);
        $statement->execute();
        $record = $statement->fetch();
        $statement->closeCursor();
        return $record;
    }


    // Handle all action verbs
    function handle_actions() {
        $id = filter_input(INPUT_GET, 'id');
        global $albums;
        global $log;

        // POST
        $action = filter_input(INPUT_POST, 'action');
        if ($action == 'create') {    
            $log->log('album CREATE');                    // CREATE
            $albums->add();
        }
        if ($action == 'update') {
            $log->log('album UPDATE');                    // UPDATE
            $albums->update();
        }

        // GET
        $action = filter_input(INPUT_GET, 'action');
        if (empty($action)) {                                  
            $log->log('album READ');                      // READ
            return $albums->list_view();
        }
       if ($action == 'add') {
            $log->log('album Add View');
            return $albums->add_view();
        }
        if ($action == 'clear') {
            $log->log('album DELETE ALL');
            return $albums->clear();
        }
        if ($action == 'delete') {
            $log->log('album DELETE');                    // DELETE
            return $albums->delete($id);
        }
        if ($action == 'edit' and ! empty($id)) {
            $log->log('album Edit View');
            return $albums->edit_view($id);
        }
    }
       

    // Query for all albums
    function query_albums ($db) {
        $query = "SELECT * FROM Albums";
        $statement = $db->prepare($query);
        $statement->execute();
        return $statement->fetchAll();
    }


     // albums_list_view -- Loop over all of the log to make a bullet list
     function album_list_view($list) {

        echo '
            <div class="card">
                <h3>Albums</h3> 
                <ul class="albums">';
        foreach ($list as $c) 
        {
           echo '
            <div class="card">
                <h3>'.$c['name'].'</h3> ';
           
           echo '<img src="'. $c['artwork'] . '" alt="'. $c['artist'] .'" width="200" height="200">';
           echo '<div class="content">';
           echo 'Artist: '. $c['artist'].'<br>';
           echo '<a href="' . $c['purchaseURL'] . '">Buy</a><br>';
           echo 'Description: <br>'. $c['description'].'<br>';
           echo 'Review: '. $c['review'].'';
           echo '</div>';
           echo '<p> <a href = index.php?id=' . $c['id'] . '&action=edit> Edit Album </a></p>';
           echo '<p> <a href = index.php?id=' . $c['id'] . '&action=delete> Delete Album </a></p>';
           echo '</div>';
        }
        echo '</ul>
        </div>';
    
    }


    // Update the database
    function update_album ($db) {
        $id    = filter_input(INPUT_POST, 'id');
        $album  = filter_input(INPUT_POST, 'album');
        $artist = filter_input(INPUT_POST, 'artist');
        $purchaseLink = filter_input(INPUT_POST, 'purchaseLink');
        $artworkLink = filter_input(INPUT_POST, 'artworkLink');
        $description = filter_input(INPUT_POST, 'description');
        $review = filter_input(INPUT_POST, 'review');
        
        // Modify database row
        $query = "UPDATE albums SET artist = :artist, name = :album, artwork = :artworkLink, purchaseURL = :purchaseLink,  description = :description, review = :review WHERE id = :id";
        $statement = $db->prepare($query);

        $statement->bindValue(':id', $id);
        $statement->bindValue(':album', $album);
        $statement->bindValue(':artist', $artist);
        $statement->bindValue(':purchaseLink', $purchaseLink);
        $statement->bindValue(':artworkLink', $artworkLink);
        $statement->bindValue(':description', $description);
        $statement->bindValue(':review', $review);

        $statement->execute();
        $statement->closeCursor();
        
        global $page;
        header("Location: $page");
    }

    // Delete all database rows
    function clear_albums($db) {
        
        try {
            $query = "DELETE FROM albums";
            $statement = $db->prepare($query);
            $row_count = $statement->execute();
            return true;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Error: $error_message</p>";
            die();
        }
        
    }
 

    /* -------------------------------------------------------------
    
                        A L B U M S
    
     ------------------------------------------------------------- */

    // My album list
    class albums {

        // Database connection
        private $db;

        
        // Automatically connect
        function __construct() {
            global $db;
            $this->db =  albums_connect();
        }

        
        // CRUD
        
        function add() {
            $album  = filter_input(INPUT_POST, 'album');
            $artist = filter_input(INPUT_POST, 'artist');
            $purchaseLink = filter_input(INPUT_POST, 'purchaseLink');
            $artworkLink = filter_input(INPUT_POST, 'artworkLink');
            $description = filter_input(INPUT_POST, 'description');
            $review = filter_input(INPUT_POST, 'review');
            return add_album ($this->db, $album, $artist, $artworkLink, $purchaseLink, $description, $review);
        }
        
        function query() {
            return query_albums($this->db);
        }
        
    
        function clear() {
            return clear_albums($this->db);
        }
        
        function delete() {
            delete_album($this->db, $id);
        }
        
        function get($id) {
            return get_album($this->db, $id);
        }
        
        function update() {
            update_album($this->db);
        }
        
        
        // Views
        
        function handle_actions() {
            return handle_actions();
        }
        
        function add_view() {
            return add_album_view();
        }
        
        function edit_view($id) {
            return edit_album_view($this->get($id));
        }
        
        function list_view() {
            return album_list_view($this->query());
        }
        
    }


    // Create a list object and connect to the database
    $albums = new albums;

?>
