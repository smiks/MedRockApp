<?php

require_once 'Controller.php';
require_once 'core/Functions.php';
require_once 'app/models/user.php';
require_once 'app/models/history.php';

class PatientHistory extends Controller{

	public function __construct(){
		

	}

	public function post() {
	}

	public function get() {

		/* get info about queue */
		$hist = new history();
		$h = $hist->getUserHistory($_SESSION['userID']);
		$history = [];

		foreach($h as $key => $value){
			array_push($history, $value);
		}

		$hist->allRead($_SESSION['userID']);
		$data = ["history" => $history];
		$this->render("history.view.php", $data);

		return;
	}



}