<?php
	
class AccountController extends PageController { 

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

		  // Did the user submit the new post form
		 if ( isset($_POST["new-post"]) ) {
		 	$this->processNewPost();
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
			 //  die ("update");
		
			 // Form validation passed
			 // Time to update the data
			$firstName = $this->dbc->real_escape_string($_POST["first-name"]);
			$lastName = $this->dbc->real_escape_string($_POST["last-name"]);

			$userID = $_SESSION["id"];

			 // Prepare the sql
			$sql = "UPDATE users
					set first_name = '$firstName',
						last_name = '$lastName'
					WHERE id = $userID ";

			 // Run the query
			$this->dbc->query( $sql );
		
		}


	}

	private function processNewPost() {

		 // echo "<pre>";
		 //print_r($_FILES);
		 //die();

		 // Count errors
		$totalErrors = 0;
		$title = trim($_POST["title"]); // $title to store the trimmed title
		$desc = trim($_POST["desc"]); // $title to store the trimmed description

		 // Validate title; trim extra spaces in the title
		if ( strlen( $title ) == 0) {
			$this->data["titleMessage"] = "<p>Required</p>";
			$totalErrors ++;
		} elseif ( strlen( $title ) > 100) {
			$this->data["titleMessage"] = "<p>Cannot be more than 100 characters</p>";
			$totalErrors ++;
		  }

		 // Validate desc; trim extra spaces in the desc
		if ( strlen( $desc ) == 0) {
			$this->data["descMessage"] = "<p>Required</p>";
			$totalErrors ++;
		 } elseif ( strlen( $desc ) > 1000) {
			$this->data["descMessage"] = "<p>Cannot be more than 1000 characters</p>";
			$totalErrors ++;
		  }

		 // If there are no errors
		if ( $totalErrors == 0 ) {
			# code...
			 // Filter the data
			$title = $this->dbc->real_escape_string($title);
			$desc = $this->dbc->real_escape_string($desc);

			 //Get the id of logged-in user
			$userID = $_SESSION["id"];

			 //  SQL inset
			$sql = "INSERT INTO posts (title, description, user_id)
					VALUES ('$title', '$desc', $userID) ";

			$this->dbc->query( $sql );

			 // Make sure it worked
			if ( $this->dbc->affected_rows ) {
				$this->data["postMessage"] = "Success";
			} else  {
				$this->data["postMessage"] = "Something went wrong.";
			};


			// Success message or error message 



		 }

	}




}
