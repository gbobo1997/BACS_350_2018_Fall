<?php 
	require_once 'db.php';

	class Album
	{
		private $artist;
		private $name;
		private $artwork;
		private $purchase_url;
		private $description;
		private $review;
		private $db;

		function __construct()
		{
			$this->db = album_connect();
		}

		function set($artist_, $name_, $artwork_, $purchase_url_, $description_, $review_)
		{
			$this->artist = $artist_;
			$this->name = $name_;
			$this->artwork = $artwork_;
			$this->purchase_url = $purchase_url_;
			$this->description = $description;
			$this->review = $review_;
		}

		// Retrieve albums
		function query()
		{
			return query_albums($this->db);
		}

		// Add this album
		function add($success)
		{
			return add_album($this->db, $this->artist, $this->name, $this->artwork, $this->purchase_url, $this->description, $this->review, $success);
		}
	}

?>