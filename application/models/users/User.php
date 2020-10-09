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
		}

		public function login($sUser, $sPass)
		{
			$sSql = User::GET_USER_LOGIN;
			$oQuery = $this->db->query($sSql, array($sUser, $sPass));
			$oUser = $oQuery->row();

			return $oUser; 
		}

		public function updateValue($iId, $sValor, $sProveedor)
		{
			try {

				$oJugador = new stdClass();
				$oJugador->valor = $sValor;
				$this->db->where('id', $iId);
				
				if ($sProveedor == 'psd') {
					$this->db->update('jugadores', $oJugador);
				}

				if ($sProveedor == 'sofifa') {
					$this->db->update('jugadores_sofifa', $oJugador);
				}

				return true;		
			} catch (Exception $e) {
				return false;
			}
		}
	}
 ?>