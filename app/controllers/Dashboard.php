<?php

require_once 'Controller.php';
require_once 'core/Functions.php';
require_once 'app/models/doctor.php';
require_once 'app/models/queue.php';

class Dashboard extends Controller{

	public function __construct(){
		

	}

	public function post() {
		$doc = new doctor();
		$post = Functions::input("POST");
		$postedID = $post["userid"];
		/* check user credentials */
			$exists = $doc->exists("doctorCode", $postedID);
			/* if not ok, show errors */
			if(!$exists){
				$data = ["message" => "This doctor code does not exist."];
				$this->render("error.view.php", $data);
				return;
			}

		/* if ok, login user */
		$docid = $doc->selectData("doctorID", "doctorCode", $postedID);
		$_SESSION['doctorID'] = $docid;
		$_SESSION['doctorCode'] = $postedID;
		$_SESSION['loggedin'] = true;
		
		Functions::redirect(Functions::internalLink("/dashboard/"));
		return;

	}

	public function get() {

		/* get info about queue */
		$que = new queue();
		$queue = $que->getQueueWithDetails();
		$patients = [];

		foreach($queue as $key => $value){
			array_push($patients, $value);
		}

		$data = ["patients" => $patients];
		$this->render("dashboard.view.php", $data);
	}



}