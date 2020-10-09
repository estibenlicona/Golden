<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
	}

	public function start()
	{
		$aHead['title'] = "Iniciar sesión";
		$this->load->view('head', $aHead);
		$this->load->view('login');
	}

}
