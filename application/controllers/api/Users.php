<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use \Restserver\Libraries\REST_Controller;
/**
 * 
 */
class Users extends REST_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
    }

    public function index_get()
    {
        header("Location: " . base_url('/login/start'));
    }

    public function login_post()
    {    
        // Post
        $sUser = $this->post('username');
        $sPass = $this->post('password');
        
        // Loads
        $this->load->model("users/User");

        // Login
        $oUser = new User();
        $oData = $oUser->login($sUser, $sPass);

        
        if ($oData) {
            $this->session->set_userdata('login', true);
            header("Location: " . base_url('/jugadores'));
        }else{
            $this->session->unset_userdata('login');
            $this->session->set_flashdata('error', 'Datos incorrectos.');
            header("Location: " . base_url('/login/start'));
        }

    }

    public function out_get()
    {
        $this->session->unset_userdata('login');
        header("Location: " . base_url('/jugadores'));
    }

    public function updatevalueplayer_post()
    {    
        // Post
        $iId = $this->post('jugador');
        $sValor = $this->post('valor');
        $sProveedor = $this->post('proveedor');
        
        // Loads
        $this->load->model("users/User");

        // Login
        $oUser = new User();
        $oUser->updateValue($iId, $sValor, $sProveedor);

        header("Location: " . base_url("/jugador/{$sProveedor}/{$iId}"));

    }
}

 ?>