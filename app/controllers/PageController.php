<?php

	 // abstract class so you can't make an instance of it
	abstract class PageController {
		protected $title;
		Protected $metadesc;
		protected $dbc;
		protected $plates;
		protected $data = [];

		public function __construct() {
			$this->plates = new League\Plates\Engine ("app/templates");

		}
	  // Force children classes to have the 
	abstract public function buildHTML();

	


	public function mustBeLoggedIn() {

		 // Redirect the user to the login page
		if ( !isset($_SESSION["id"]) ) {
			header ("Location: index.php?page=login");
		}
	 }



	}