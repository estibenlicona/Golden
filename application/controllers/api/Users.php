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

    public function login_post()
    {    
        // Post
        $sUser = $this->post('email');
        $sPass = $this->post('password');
        
        // Loads
        $this->load->model("users/User");
        $this->load->library("Authorization_Token");

        // Login
        $oUser = new User();
        $oData = $oUser->login($sUser, $sPass);

        //Generate token
        $sToken = $this->authorization_token->generateToken($oData);

        //Response
        $this->response([
                'message' => 'Autenticación exitosa',
                'data' => [
                    'token' => $sToken
                ]
            ], 
            REST_Controller::HTTP_OK
        );
    }

    public function out_post()
    {
        $this->session->sess_destroy();
        $this->response([
                'status' => TRUE,
                'message' => "Sesión terminada."
            ], 
            REST_Controller::HTTP_OK
        );
    }
}

 ?>