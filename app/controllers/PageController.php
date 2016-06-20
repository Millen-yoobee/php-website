<?php

	 // abstract class so you can't make an instance of it
	abstract class PageController {
		protected $title;
		Protected $metadesc;
		protected $dbc;
		protected $plates;

		public function __construct() {
			$this->plates = new League\Plates\Engine ("app/templates");

		}
	  // Force children classes to have the 
	abstract public function buildHTML();

	}
