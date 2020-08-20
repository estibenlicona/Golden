<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	/**
	 * 
	 */
	class User extends CI_Model
	{

		const GET_USER_LOGIN = "SELECT 
								 user as name,
								 'https://lh3.googleusercontent.com/ogw/ADGmqu9B9LI88LPJVJnmhY8cq6Drg_BxquLJLS-rF-es=s32-c-mo' as 
								 picture 
								FROM users WHERE user = ? AND pass = ?;";
		
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