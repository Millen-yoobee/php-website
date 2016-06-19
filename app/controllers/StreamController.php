<?php

class StreamController extends PageController {

	 // Properties
	private $top5Favourites;



	// Constructor
	public function __construct($dbc) {
		$this->dbc = $dbc;

		 // if you are not logged in
		if ( !isset($_SESSION["id"]) ) {
			header ("Location: index.php?page=login");
		}

	}


	// Methods (functions)
	public function buildHTML() {

	}


}