<?php

    // Bring in albums logic
    require_once 'album_db.php';
    require_once 'album_crud.php';
    require_once 'album_views.php';


    // My album list
    class albums {

        // Database connection
        private $db;

        
        // Automatically connect
        function __construct() {
            $this->db =  albums_connect();
        }

        
        // CRUD
        
        function query() {
            return query_albums($this->db);
        }
        
    
        function clear() {
            return clear_albums($this->db);
        }
        
        
        function add($album, $artist, $artworkLink, $purchaseLink, $description, $review) {
            return add_album ($this->db, $album, $artist, $artworkLink, $purchaseLink, $description, $review);
        }
        
        function handle_actions() {
            $action = filter_input(INPUT_POST, 'action');
            if ($action == 'add') {
                $album  = filter_input(INPUT_POST, 'album');
                $artist = filter_input(INPUT_POST, 'artist');
                $artworkLink = filter_input(INPUT_POST, 'artworkLink');
                $purchaseLink = filter_input(INPUT_POST, 'purchaseLink');
                $description = filter_input(INPUT_POST, 'description');
                $review = filter_input(INPUT_POST, 'review');
                $this->add($album, $artist, $artworkLink, $purchaseLink, $description, $review);
            }
            $action = filter_input(INPUT_GET, 'action');
            if ($action == 'clear') {
                $this->clear();
            }
        }
        
        // Views
        
        function show_albums() {
            album_list_view($this->query());
        }
        
        
        function add_form() {
            add_album_form();
        }
    }


    // Create a list object and connect to the database
    $albums = new albums;

?>
