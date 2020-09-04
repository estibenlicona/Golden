<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jugador extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
	}

	public function index()
	{
		$sql = "SELECT DISTINCT * FROM habilidades;";
		$query = $this->db->query($sql);
		$aHabilidades = $query->result();

		$aData = array();
		$aData['aHabilidades'] = $aHabilidades;
		$this->load->view('jugador/index', $aData);
	}

	public function psd($id)
	{
		$this->load->model("players/Player");
        $oPlayer = new Player();
        $oPlayer->update_id($id);
        $aData = $oPlayer->format_psd($id);
		$aData['user'] = $this->session->userdata();

		$this->load->view('head', array('title' => 'Jugadores'));
		$this->load->view('nav');
		$this->load->view('jugador/psd', $aData);
	}


	public function sofifa($id)
	{
		$this->load->model("players/Player");
		$oPlayer = new Player();
        $aData = $oPlayer->format_sofifa($id);
		$this->load->view('jugador/sofifa', $aData);
	}

	public function create()
	{
		$aHead = array();
		$aHead['title'] = "Crear Jugador SOFIFA";

		$this->load->view('head', $aHead);
		$this->load->view('nav');
		$this->load->view('jugador/crear');
	}

	public function sincronizar()
	{
		$aHead['title'] = "Sincronizador";
		$this->load->view('head', $aHead);
		$this->load->view('jugador/sincronizar');
	}

}
