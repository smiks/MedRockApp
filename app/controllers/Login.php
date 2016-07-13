<?php

require_once 'Controller.php';
require_once 'core/Functions.php';
require_once 'app/models/user.php';

class Login extends Controller{

	public function __construct(){
		

	}

	public function post() {
		$user = new user();
		$post = Functions::input("POST");
		$postedID = $post["userid"];
		/* check user credentials */
			$exists = $user->exists("userNumber", $postedID);
			/* if not ok, show errors */
			if(!$exists){
				$data = ["message" => "This user does not exist."];
				$this->render("error.view.php", $data);
				return;
			}

		/* if ok, login user */
		$userid = $user->selectData("userID", "userNumber", $postedID);
		$userName = $user->selectData("userName", "userNumber", $postedID);
		$userSurname = $user->selectData("userSurname", "userNumber", $postedID);
		$_SESSION['userID'] = $userid;
		$_SESSION['userNumber'] = $postedID;
		$_SESSION['loggedin'] = true;
		$_SESSION['userName'] = $userName;
		$_SESSION['userSurname'] = $userSurname;		
		
		Functions::redirect(Functions::internalLink("home/"));
		return;

	}

	public function get() {


		$data = ["welcomeMessage" => "Hello World!"];
		$this->render("login.view.php", $data);
	}



}