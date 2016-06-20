<?php

class StreamController extends PageController {

	 // Properties
	private $top5Favourites;



	// Constructor
	public function __construct($dbc) {
		 // Run the parent constructor
		 //:: another way to run functions
		parent::__construct();

		$this->dbc = $dbc;

		 // if you are not logged in
		if ( !isset($_SESSION["id"]) ) {
			header ("Location: index.php?page=login");
		}

	}


	// Methods (functions)
	public function buildHTML() {

		// Get latest posts (pins)
		$allData = $this->getLatestPosts();
		$data = [];

		$data["allPosts"] = $allData;

		echo $this->plates->render("stream", $data);
	}

	private function getLatestPosts() {
		 // Prepare some sql
		$sql = "SELECT * 
			   FROM posts";

		 // Run the sql and capture the result
		$result = $this->dbc->query($sql);

		 // Extract the results as an array
		$allData = $result->fetch_all(MYSQLI_ASSOC);

			// echo"<pre>"; for debugging
			// print_r($allData);
			// die();

		// Return the results to the code that called this function
		return $allData;

	}



}