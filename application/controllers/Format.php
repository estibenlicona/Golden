<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Format extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function index()
	{
		$sql = "SELECT stast FROM jugadores WHERE id = 21163;";
		$query = $this->db->query($sql);
		$sStast = $query->result();
		$aStast = preg_split('/\n|\r\n?/', rtrim(ltrim($sStast[0]->stast)));
		$oJugador = new stdClass();
		$sClaveEspecial = "";
		foreach ($aStast as $key => $sStast) {

			 $aHabilidad = explode(":", $sStast);
			 if (count($aHabilidad) == 2) {
				 
				//Formatear Clave
				$sClave = str_replace(" ", "_", ltrim(rtrim(strtolower($aHabilidad[0])))); 
				// Condiciones especiales
				if ($sClave == 'condition/fitness') {
				 	$sClave = 'condition_fitness';
				}				 

				if ($sClave == 'attack_/_defence_awareness') {
				 	$sClave = 'attack_defence_awareness';
				}

				$sValor = ltrim(rtrim($aHabilidad[1])); 

				if (empty($sClaveEspecial)) {
					$oJugador->$sClave = $sValor;
				}

				if ($sClave == "special_abilities") {
				 	$sClaveEspecial = "special_abilities";
				 	//$oJugador->$sClaveEspecial = array();
				 	$oJugador->$sClaveEspecial = Null; //@Pendiente
				}

				if ($sClave == "motion_style") {
				 	$sClaveEspecial = "motion_style";
				 	//$oJugador->$sClaveEspecial = array();
				 	$oJugador->$sClaveEspecial = Null; //@Pendiente
				}
				if ($sClave == "attack_defence_awareness") {
				 	$sClaveEspecial = "attack_defence_awareness";
				 	//$oJugador->$sClaveEspecial = array();
				 	$oJugador->$sClaveEspecial = Null; //@Pendiente
				}
			 }
/*
			 if (count($aHabilidad) == 1) {
			 	$sValor = ltrim(rtrim($aHabilidad[0]));
			 	if (strlen($sValor) > 0) {
			 		$oJugador->$sClaveEspecial[] = $sValor;
			 	}
			 }
*/
			unset($oJugador->special_abilities);//@Pendiente
			unset($oJugador->motion_style);//@Pendiente
			unset($oJugador->attack_defence_awareness);//@Pendiente

			$this->db->where('id', 1562);
			$this->db->update('jugadores', $oJugador);
		}

		echo json_encode($oJugador);
	}

	public function updatestast()
	{
		$sSql = "SELECT id, stast FROM jugadores WHERE club IS NULL AND stast IS NOT NULL AND stast != '';";
		$oQuery = $this->db->query($sSql);
		$aJugadores = $oQuery->result();

		foreach ($aJugadores as $oJugador) {
			$aStast = preg_split('/\n|\r\n?/', rtrim(ltrim($oJugador->stast)));
			$sClaveEspecial = "";
			foreach ($aStast as $key => $sStast) {

				 $aHabilidad = explode(":", $sStast);
				 if (count($aHabilidad) == 2) {
					 
					//Formatear Clave
					$sClave = str_replace(" ", "_", ltrim(rtrim(strtolower($aHabilidad[0])))); 
					// Condiciones especiales
					if ($sClave == 'condition/fitness') {
					 	$sClave = 'condition_fitness';
					}				 

					if ($sClave == 'attack_/_defence_awareness') {
					 	$sClave = 'attack_defence_awareness';
					}

					$sValor = ltrim(rtrim($aHabilidad[1])); 

					if (empty($sClaveEspecial)) {
						$oJugador->$sClave = $sValor;
					}

					if ($sClave == "special_abilities") {
					 	$sClaveEspecial = "special_abilities";
					 	//$oJugador->$sClaveEspecial = array();
					 	$oJugador->$sClaveEspecial = Null; //@Pendiente
					}

					if ($sClave == "motion_style") {
					 	$sClaveEspecial = "motion_style";
					 	//$oJugador->$sClaveEspecial = array();
					 	$oJugador->$sClaveEspecial = Null; //@Pendiente
					}
					if ($sClave == "attack_defence_awareness") {
					 	$sClaveEspecial = "attack_defence_awareness";
					 	//$oJugador->$sClaveEspecial = array();
					 	$oJugador->$sClaveEspecial = Null; //@Pendiente
					}
				 }

				unset($oJugador->special_abilities);//@Pendiente
				unset($oJugador->motion_style);//@Pendiente
				unset($oJugador->attack_defence_awareness);//@Pendiente

				$this->db->where('id', $oJugador->id);
				$this->db->update('jugadores', $oJugador);
			}
		}
	}

}
