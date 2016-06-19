<?php

	 // abstract class so you can't make an instance of it
	abstract class PageController {
		protected $title;
		Protected $metadesc;
		protected $dbc;

	  // Force children classes to have the 
	abstract public function buildHTML();

	}
