<?php

require_once 'Controller.php';
require_once 'core/Functions.php';
require_once 'app/models/history.php';
require_once 'app/models/queue.php';
require_once 'app/models/user.php';
require_once 'app/models/information.php';
require_once 'lib/Time.php';

class UpdateStatus extends Controller{

	public function __construct(){
		

	}


	public function post() {
		$hist = new history();
		$user = new user();

		/* get posted input data */
		$post = Functions::input("POST");

		$notes = $post["notes"];
		$visit = false;
		$hid = $post["hid"];
		if(isset($_POST['submitShouldVisit'])){
			$visit = true;
		}


		$data = ["estimatedWaitingTime" => $estimatedWaitingTime, 
				"averageWaitingTime" => $avgWaitingTime];

		$this->render("postData.view.php", $data);
		return;

	}

	public function get() {

	}



}