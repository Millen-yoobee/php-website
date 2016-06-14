<?php

class LandingController {

 // Properties
	private $emailMessage;
	private $passwordMessage;

 // Constructor
	public function __construct () {

		// die ( "Landing controller has been made" ); // for debugging purposes

		// echo "<pre>"   // for debugging purposes;
		//  print_r( $_POST );   // for debugging purposes
		// echo "</pre>";   // for debugging purposes

		 // If the user has submitted theregistration form
		if ( isset ($_POST ["new-account"] ) ) {
			// die ("Submitted form");   // for debugging

			$this -> validateRegistrationForm ();
		}

	 }


  // Methods	
	public function registerAccount () {

		// validate the user data

		// check in the database if the email is already in use

		// check the strength of the psw

		// Register the account OR show error messages

		// If successful, log user in & redirect to their brand new stream page/account

	}


	public function buildHTML () {
 		 // $plates is the plates library
		 // Instantiate (create) an instance of the Plates library
		$plates = new League\Plates\Engine ("app/templates");

		 // Prepare a container for data
		$data = [];

		if ( $this -> emailMessage != "") {
			$data ["emailMessage" ] = $this -> emailMessage;
		}

		if ( $this -> passwordMessage != "") {
			$data ["passwordMessage" ] = $this -> passwordMessage;
		}

		echo $plates -> render ("landing", $data);
	}


	private function validateRegistrationForm () {
		 // die ("go");   //for debugging

		$totalErrors = 0;

		// Make sure an email has been provided and is valid
		if ( $_POST [ "email" ] == "") {
			 // e-mail is invalid
			$this -> emailMessage = "Invalid e-mail";
			$totalErrors ++;
		}
		  // Check if psw is < 8 characters
		
		if ( strlen ( $_POST ["password"]) < 8 ) {
			$this -> passwordMessage = "Must have at least 8 characters";
			$totalErrors ++;
		 }

		  // Determine if this data is valid to go into the database
		 if ($totalErrors == 0) {
		 	
		 }

	 }




}