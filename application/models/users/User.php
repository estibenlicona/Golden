<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	/**
	 * 
	 */
	class User extends CI_Model
	{

		const GET_USER_LOGIN = "SELECT * FROM users WHERE user = ? AND pass = ?;";
		
		function __construct()
		{
			parent::__construct();
			$this->load->database();
			$this->load->library('session');
		}

		public function login($sUser, $sPass)
		{
			$sSql = User::GET_USER_LOGIN;
			$oQuery = $this->db->query($sSql, array($sUser, $sPass));
			$oUser = $oQuery->row();
			
			return $oUser; 
		}
	}
 ?>