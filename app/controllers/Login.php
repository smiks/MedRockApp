<?php

require_once 'Controller.php';
require_once 'core/Functions.php';

class Login extends Controller{

	var $garbage;
	var $garbageProtected;

	public function __construct(){
		

	}

	public function post() {
		$post = Functions::input("POST");

		/* check user credentials */

			/* if not ok, show errors */

		/* if ok, login user */

	}

	public function get() {


		$data = ["welcomeMessage" => "Hello World!"];
		$this->render("login.view.php", $data);
	}



}