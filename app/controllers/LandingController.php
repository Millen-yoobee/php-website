<?php

class LandingController {

 // Properties


 // Constructor



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

		echo $plates -> render ("landing");
	}

}