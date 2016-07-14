<?php

require_once 'Controller.php';
require_once 'core/Functions.php';
require_once 'app/models/history.php';
require_once 'app/models/queue.php';
require_once 'app/models/user.php';
require_once 'app/models/information.php';
require_once 'lib/Time.php';

class PostData extends Controller{

	public function __construct(){
		

	}

	private function calculateAge($age){
		$splits = explode("/", $age);
		$cyear  = date("Y");
		$year   = $splits[2];
		if($cyear == $year){
			$cmonth = date("n");
			$month = (int)($splits[1]);
			return (($cmonth-$month)+1)/12;
		}

		return ($cyear - $year);
	}


	private function myMap($array){
		$newArray = [];
		foreach($array as $key => $value){
			$tmp = $this->sigmoid($value);
			array_push($newArray, $tmp);
		}

		return $newArray;
	}

	private function sigmoid($t, $_delta = 1, $_eps = 0){
		$e = 2.7182818284;
		return 1/(1+(pow(($e), -1*($_delta*$t+$_eps))));
	}

	private function normalize($x, $a, $b){
		$range = ($b - $a) + 1;
		return ($b - $x) / $range;
	}


	private function inverse($a){
		return (1-$a);
	}


	public function post() {
		$hist = new history();
		$user = new user();

		/* get posted input data */
		$post = Functions::input("POST");
		
		$weight = $post["bodyWeight"];
		$height = $post["bodyHeight"];

		$temperature = $post["temperature"];
		$heartRate = $post["heartRate"];
		$saturation = $post["saturation"];
		$systolic = $post["bloodPressureSys"];
		$diastolic = $post["bloodPressureDia"];
		$breathingRate = $post["breathingRate"];

		$cough = $post["cough"];
		$puke = $post["puke"];
		$diz = $post["dizziness"]; /* dizziness */

		$age = $user->getAge($_SESSINO['userID']);
		$age = $this->calculateAge($age);
 
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
				"cough" => $cough,
				"vomit" => $puke,
				"dizziness" => $diz,
				"age" => $age,
				"addedDate" => $addedDate];

		$hist->add($data);



		/* PREPARE FOR DATAMINING */

			/* FIRST: NORMALIZE DATA */
				/* normalize each data depending on its range */
				
				/* different criteria for different age */
				$normTemp = $this->normalize($temperature, 34, 42.5);
				$normTemp = $this->inverse($normTemp); /* one of the inverse */
				if($temperature < 34){
					$normTemp = 1;
				}
				
				if($heartRate > 40){
					$normHeart = $this->normalize($heartRate, 40, 240);
					$normHeart = $this->inverse($normHeart); 	/* one of the inverse */
				}
				else{
					$normHeart = $this->normalize($heartRate, 10, 40);
				}

				/* wrong */
				/*
				if($age < 5){
					$normHeart = $this->normalize($heartRate, 60, 120);
				}
				elseif($age < 10){
					$normHeart = $this->normalize($heartRate, 60, 110);
				}
				else{
					$normHeart = $this->normalize($heartRate, 60, 100);
				}
				*/
				$normSaturation  = $this->normalize($saturation, 30, 100);

				$normSys = $this->normalize($systolic, 70, 220); 	/* one of the inverse */
				$normSys = $this->inverse($normSys);
				$normDia = $this->normalize($diastolic, 40, 150); 	/* one of the inverse */
				$normDia = $this->inverse($normDia);

				$normBreath = $this->normalize($breathingRate, 9, 70);

				/* for weight and height, BMI is going to be used */
				$bmi = ($weight) / (($height/100)*($height/100));
				/* calculate differently for different ranges */
				if($bmi < 19){
					$normBmi = 1 - 19/(19-$bmi);
				}
				elseif($bmi > 25){
					$normBmi = 1 - $bmi/($bmi-25);
				}
				else{
					$normBmi = 0;
				}

				$normCough = $cough;
				$normPuke = $puke;
				$normDizz = $diz;


			/* prepare vector */
			$_X = [];
			array_push($_X, $normTemp);
			array_push($_X, $normHeart);
			array_push($_X, $normSaturation);
			array_push($_X, $normSys);
			array_push($_X, $normDia);
			array_push($_X, $normBreath);
			array_push($_X, $normBmi);
			array_push($_X, $normCough);
			array_push($_X, $normPuke);
			array_push($_X, $normDizz);


			/* USE SIGMOID: LOGISTIC REGRESSION */
				$_lambda = 1.0;  /* regularization parameter */
				$_threshold = 0.50;

				$preSum = array_sum($_X)*$_lambda;

				$_X2 = $this->myMap($_X);
				$sum = array_sum($_X2)*$_lambda;

			/* MAKE A PREDICTION */
				$_size = sizeOf($_X);
				$_ratio = $preSum/$_size;
				$prediction = $this->sigmoid($_ratio, $_delta = 7, $_eps = -3);
				//$prediction = $this->normalize($sum, 0, $_regularizedSize);
				//$prediction = $this->sigmoid($prediction);

			/* INFORM USER ABOUT A PREDICTION */
				//echo"<br>DEBUG<br>";
				//print_r($_X);
				//echo"<br>";
				//print_r($_X2);
				//echo"<br>";
				//echo"presum: {$preSum} <br> ratio: {$_ratio} <br> sum: {$sum} <br> regSize: {$_regularizedSize} <br> prediction: {$prediction}<br>";
				//exit();
				$recommendation = "There is no need to pay a visit at a doctor's.";
				if($prediction > $_threshold){
					$recommendation = "We recommend you to pay a visit at a doctor's.";
				}




	/* calculate estimated waiting time */
		
		/* get current total waiting time */
		$que = new queue();
		$totalTime = $que->getQueueTime();

		/* get info about average waiting time */
		$info = new information();
		$avgWaitingTime = $info->selectAlldata("infoName", "averageWaitingTime")["infoValue"];

		/* update queue */
		$lastHistoryID = $hist->lastID($_SESSION['userID']);
		$data = ["userID" => $_SESSION['userID'], 
				"waitingTime" => $avgWaitingTime,
				"historyID" => $lastHistoryID, 
				"addedTimestamp" => time()];

		$que->add($data);
		

		/* estimated waiting time */
		$estimatedWaitingTime = $totalTime + $avgWaitingTime;


		/* if everything OK, go to view and logout user */

		$data = ["prediction" => $recommendation, "predictionValue" => $prediction];

		$this->render("postData.view.php", $data);
		return;

	}

	public function get() {


		$data = ["welcomeMessage" => "Hello World!"];
		$this->render("login.view.php", $data);
	}



}