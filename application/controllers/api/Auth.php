<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use \Restserver\Libraries\REST_Controller;
/**
 * 
 */
class Auth extends REST_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        header("Allow: GET, POST, OPTIONS, PUT, DELETE");
        header('Content-Type: application/json');
        $method = $_SERVER['REQUEST_METHOD'];
        if($method == "OPTIONS") {
            die();
        }
    }

    public function login_post()
    {
        // Post
        $sUser = $this->post('email');
        $sPass = $this->post('password');
        
        // Loads
        $this->load->model("users/User");

        // Login
        $oUser = new User();
        $oData = $oUser->login($sUser, $sPass);

print_r($oData);
    }

    public function logout_get()
    {
        $this->response([
                'message' => "Sesión terminada."
            ], 
            REST_Controller::HTTP_OK
        );
    }
}

 ?>