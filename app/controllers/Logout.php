<?php

require_once 'Controller.php';
require_once 'core/Functions.php';

class Logout extends Controller{

	public function __construct(){
		

	}

	public function post() {

	}

	public function get() {


		/* logout */
		unset($_SESSION);
		session_destroy();
		Functions::redirect(Functions::internalLink("/login/"));
		return;		

	}



}