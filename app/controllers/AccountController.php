<?php
	
class AccountController extends PageController {

	private $firstNameMessage;
	private $lastNameMessage;
	private $emailMessage;

	public function __construct($dbc) {
		 // Run the parent constructor
		 //:: another way to run functions
		parent::__construct();

		$this->dbc = $dbc;

		 // Check if user logged in; if not, redirect to login page
		$this-> mustBeLoggedIn();

		 // If the user submit new contact details, validate new details
		 		if ( isset( $_POST["update-contact"] ) ) {
			$this->processNewContactDetails();
		}
	}

	public function buildHTML() {

		// Get latest posts (pins)
		// $allData = $this->getLatestPosts();
		// $data = [];

		// $data["allPosts"] = $allData;


		echo $this->plates->render("account", $this->data);
	}

	private function processNewContactDetails() {

		 // Validation
		$totalErrors = 0;

		 // Validate the first name
		if ( strlen($_POST["first-name"]) > 50 ) {
			$this->data["firstNameMessage"] = "<p>Must be at most 50 characters </p>";
			$totalErrors ++;
		}

		if ( strlen($_POST["last-name"]) > 50 ) {
			$this->data["lastNameMessage"] = "<p>Must be at most 50 characters</p>";
			$totalErrors ++;
		}
		if ( $totalErrors == 0) {
			die ("update");
		}
	}



}
