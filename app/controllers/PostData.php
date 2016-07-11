<?php

require_once 'Controller.php';
require_once 'core/Functions.php';
require_once 'app/models/history.php';
require_once 'app/models/queue.php';
require_once 'app/models/information.php';
require_once 'lib/Time.php';

class PostData extends Controller{

	public function __construct(){
		

	}

	public function post() {
		$hist = new history();

		/* get posted input data */
		$post = Functions::input("POST");
		
		$weight = $post["weight"];
		$height = $post["height"];

		$temperature = $post["temperature"];
		$heartRate = $post["heartRate"];
		$saturation = $post["saturation"];
		$systolic = $post["bloodPressureSys"];
		$diastolic = $post["bloodPressureDia"];
		$breathingRate = $post["breathingRate"];

		$addedDate = Time::dateDB();


		/* TODO :: check for errors or empty fields */
		/* might be useful to check if patient is already in queue */


		/* store data to DB */
		$data = ["userID" => $_SESSION['userID'], 
				"temperature" => $temperature, 
				"heartRate" => $heartRate,
				"saturation" => $saturation, 
				"bloodPressureSys" => $systolic, 
				"bloodPressureDia" => $diastolic, 
				"breathingRate" => $breathingRate, 
				"weight" => $weight, 
				"height" => $height, 
				"addedDate" => $addedDate];

		$hist->add($data);

	/* calculate estimated waiting time */
		
		/* get current total waiting time */
		$que = new queue();
		$totalTime = $que->getQueueTime();

		/* get info about average waiting time */
		$info = new information();
		$avgWaitingTime = $info->selectAlldata("infoName", "averageWaitingTime")["infoValue"];

		/* update queue */
		$data = ["userID" => $_SESSION['userID'], 
				"waitingTime" => $avgWaitingTime,
				"addedTimestamp" => time()];

		$que->add($data);
		

		/* estimated waiting time */
		$estimatedWaitingTime = $totalTime + $avgWaitingTime;


		/* if everything OK, go to view and logout user */

		$data = ["estimatedWaitingTime" => $estimatedWaitingTime, 
				"averageWaitingTime" => $avgWaitingTime];

		/* logout */
		unset($_SESSION);
		session_destroy();

		$this->render("postData.view.php", $data);
		return;

	}

	public function get() {


		$data = ["welcomeMessage" => "Hello World!"];
		$this->render("login.view.php", $data);
	}



}