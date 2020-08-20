<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sincronizador extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function start()
	{
		//$sql = "SELECT id, stast FROM jugadores WHERE stast IS NULL;";
		$sql = "SELECT id, stast FROM jugadores WHERE stast IS NULL;";
		$query = $this->db->query($sql);
		$aJugadores = $query->result();
		foreach ($aJugadores as $oJugador) {

			$url = "https://pes-editor.herokuapp.com/index.php?v=6&p={$oJugador->id}";

			$curl = curl_init();
			curl_setopt($curl, CURLOPT_URL, $url);
			curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: text/plain'));
			curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_BINARYTRANSFER, true);
			$stast = curl_exec($curl);

			if (!curl_error($curl)){
	        	$data = array(
				        'stast' => $stast,
				        'update_date' => date("Y-m-d H:i:s")
				);

				$this->db->update('jugadores', $data, array('id' => $oJugador->id));
	        }
	        
	        curl_close($curl);
		}
	}

	public function update($id)
	{

		try {
			$sql = "SELECT id FROM jugadores WHERE id = $id;";
			$query = $this->db->query($sql);
			$bExiste = $query->result();
			if (!$bExiste) {
				echo json_encode("El jugador no se encuentra registrado.");
				return;
			}

			$url = "https://pes-editor.herokuapp.com/index.php?v=6&p={$id}";
			$curl = curl_init();
			curl_setopt($curl, CURLOPT_URL, $url);
			curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: text/plain'));
			curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_BINARYTRANSFER, true);
			$stast = curl_exec($curl);

			if (!curl_error($curl)){
	        	$data = array(
				        'stast' => $stast,
				        'update_date' => date("Y-m-d H:i:s")
				);

				$this->db->update('jugadores', $data, array('id' => $id));
	        }
	        
	        curl_close($curl);


			$oJugador = new stdClass();
			$sClaveEspecial = "";
	        $aStast = preg_split('/\n|\r\n?/', rtrim(ltrim($stast)));
			$sClave = "";
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
					 	$oJugador->$sClaveEspecial = array();
					}

					if ($sClave == "motion_style") {
					 	$sClaveEspecial = "motion_style";
					}
				 }

				if (count($aHabilidad) == 1 and $sClave == "special_abilities") {
				 	$sValor = ltrim(rtrim($aHabilidad[0]));
				 	if (strlen($sValor) > 0) {
				 		$oJugador->$sClaveEspecial[] = $sValor;
				 	}
				}

			}

			unset($oJugador->motion_style);
			$oJugador->special_abilities = implode("\n", $oJugador->special_abilities);
			$this->db->where('id', $id);
			$this->db->update('jugadores', $oJugador);

			$oResponse = new stdClass();
			$oResponse->mensaje = "Se proceso el jugador de forma exitosa.";
			$oResponse->player_name = $oJugador->name;
			$oResponse->status = ok;
			return json_encode($oResponse);

		} catch (Exception $e) {
			$oResponse = new stdClass();
			$oResponse->mensaje = "Es posible que el servicio no se encuentre disponible, por favor intentelo mas tarde.";
			echo json_encode($oResponse);
			return;
		}

	}

	public function create($id)
	{
		$sql = "SELECT id FROM jugadores WHERE id = $id;";
		$query = $this->db->query($sql);
		$bExiste = $query->result();
		if (!$bExiste) {
			$sql = "INSERT INTO jugadores(id) VALUES($id);";
			$query = $this->db->query($sql);
			$oResponse = new stdClass();
			$oResponse->mensaje = "Jugador creado exitosamente.";
			echo json_encode($oResponse);
		}else{
			echo json_encode("El jugador ya existe.");
		}

		return;
	}

}
