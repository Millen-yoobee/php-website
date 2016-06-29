<?php

class PostController extends PageController { 

	public function __construct($dbc) {
		 // Run the parent constructor
		 //:: another way to run functions
		parent::__construct();

		$this->dbc = $dbc;

		$this->getPostData();

	 }

	public function buildHTML() {

		echo $this->plates->render("post", $this->data);
	}

	private function getPostData() {
		 // Filter the id
		$postID = $this->dbc->real_escape_string( $_GET["postid"] );

		 // Get info about this post
		$sql = "SELECT title, description, image, created_at, updated_at, first_name, last_name
				FROM posts
				JOIN users
				ON user_id = users.id
				WHERE posts.id = $postID";

		 // Run the sql
		$result = $this->dbc->query($sql);

		 // If the $result is empty meaning query failed or the id = $postID not found
		if ( !$result || $result->num_rows == 0 ) {  
			 //redirect user to 404 page
			header ("Location: index.php?page=404"); 
		} else {
			 // yay

			$this->data["post"] = $result->fetch_assoc();

			$fName = $this->data["post"]["first_name"];
			$lName = $this->data["post"]["last_name"];
			if ( !$fName && !$lName ) {
				$this->data["post"]["first_name"] = "Anon";
			}


		  }

	 }
 }