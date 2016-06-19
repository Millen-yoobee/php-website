<?php

class LandingController extends PageController {

 // Properties
	private $emailMessage;
	private $passwordMessage;
	

 // Constructor
	public function __construct($dbc) {
		// die ( "Landing controller has been made" ); // for debugging purposes
		// echo "<pre>"   // for debugging purposes;
		//  print_r( $_POST );   // for debugging purposes
		// echo "</pre>";   // for debugging purposes

		// Save the database connection for later
		$this->dbc = $dbc;
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
 		
 		 // Filter user data before using it in a query
		$filteredEmail = $this->dbc->real_escape_string ( $_POST["email"] );
		 		 // die($filteredEmail);  for debugging
		$sql = "SELECT email
				FROM users
				WHERE email = '$filteredEmail' ";

		 // Run the query
		$result = $this->dbc->query($sql);

			//if the query failed or there is a result
		if ( !$result || $result->num_rows > 0 ) {
			$this -> emailMessage = "E-mail in use";
			$totalErrors ++;	
		 }

		  // Check if psw is < 8 characters
				if ( strlen ( $_POST ["password"]) < 8 ) {
			$this -> passwordMessage = "Must have at least 8 characters";
			$totalErrors ++;
		 }

		  // Determine if this data is valid to go into the database
		 if ($totalErrors == 0) {
		 	// Validation passed

		 	
		 	 // Has the password
		 	$hash = password_hash ( $_POST["password"], PASSWORD_BCRYPT );
		 		 // die($hash);
		 	 // Prepare the sql statement
		 	$sql = "INSERT INTO users (email, password) 
		 			VALUES ('$filteredEmail', '$hash')";
		 	 // die($sql); for debugging
		 	 //Run the query
		 	$this->dbc->query($sql);


		 	  // Log the user in
		 	$_SESSION["id"] = $this->dbc->insert_id;

		 	header("location: index.php?page=stream");
		 }

	 }




}