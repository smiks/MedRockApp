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
		$que = new queue();

		/* get posted input data */
		$post = Functions::input("POST");

		$notes = $post["notes"];
		$visit = 0;
		$hid = $post["hid"];
		if(isset($_POST['submitShouldVisit'])){
			$visit = 1;
		}

		$data = ["resolved" => 1,
				"requiredVisit" => $visit,
				"notes" => $notes];

		$hist->updateData("historyID", $hid, $data);
		$que->removeFromQueue($hid);

		
		Functions::redirect(Functions::internalLink("/dashboard/"));
		return;

	}

	public function get() {

	}



}