<?php
 // phpinfo(); toget info of php version

session_start();

 // require stmt below makes everything in the vnedor folder available to use
require "vendor/autoload.php";
require "app/controllers/PageController.php";


 // Load appropriate page 

// First ask if the user has requested a page
// if ( isset( $_GET ["page"] )) {
// 	// Requested page
// 	$page = $_GET ["page"];
//   }
//  else {
// 	$page = "landing";
//   }
// lines 9 to 17 can be written in the following way

$page = isset ( $_GET [ "page"]) ? $_GET ["page"] : "landing";

// Connect to the database
$dbc = new mysqli("localhost", "root", "", "pinterest");



// Load the appropriate files based on page

 switch ($page) {

 	//Landing page
 	case "landing":  
 	case "register":
 		require "app/controllers/LandingController.php";	
 		$controller = new LandingController ($dbc);

 		// echo $plates -> render ("landing"); for debugging
 		break;
 	
 	//About page
 	case "about":
  		echo $plates -> render ("about");
 		break;
 	
 	//Login page
 	case "login":
 		require "app/controllers/LoginController.php";
 		$controller = new LoginController ($dbc);

 		break;

 	//Stream page
 	case "stream":
 		require "app/controllers/StreamController.php";
 		$controller = new StreamController ($dbc);
 		break;

 	 //Account page
 	case "account":
 		require "app/controllers/AccountController.php";
 		$controller = new AccountController ($dbc);
 		break;

  	case "post":
 		require "app/controllers/PostController.php";
 		$controller = new PostController ($dbc);
 		break;
		

 	default:
 		echo $plates -> render ("error404");
 		break;
 }
 	$controller -> buildHTML ();

