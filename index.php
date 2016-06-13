<?php

// require stmt below makes everything in the vnedor folder available to use
require "vendor/autoload.php";

 // $plates is the plates library
 // Instantiate (create) an instance of the Plates library
$plates = new League\Plates\Engine ("app/templates");

 // Load appropriate page 

// First ask if the user has requested a page
if ( isset( $_GET ["page"] )) {
	// Requested page
	$page = $_GET ["page"];

 }
 else {
	$page = "landing";
 }

// Load the appropriate files based on page

 switch ($page) {

 	//Landing page
 	case "landing":  case "register":
 		echo $plates -> render ("landing");
 		break;
 	
 	//About page
 	case "about":
  		echo $plates -> render ("about");
 		break;
 	
 	//Login page
 	case "login":
 		echo $plates -> render ("login");
 		break;

 	//Stream page
 	case "stream":
 		echo $plates -> render ("stream");
 		break;

 	default:
 		echo $plates -> render ("error404");
 		break;
 }


