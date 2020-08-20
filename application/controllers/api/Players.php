<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use \Restserver\Libraries\REST_Controller;
/**
 * 
 */
class Players extends REST_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    public function index_get()
    {
        $this->response([
                'status' => FALSE,
                'message' => 'Accion no permitida.'
            ], 
            REST_Controller::HTTP_OK
        );
    }
    
    public function search_post()
    {
        $sFields = $this->post('fields');
        $aFilters = $this->post('filters');
        $this->load->model("players/Player");
        $oPlayer = new Player();
        $oResponse = $oPlayer->search($sFields, $aFilters);

        $this->response([
                'status' => TRUE,
                'message' => 'Controlador implementado correctamente.',
                'body' => $oResponse
            ], 
            REST_Controller::HTTP_OK
        );
    }

    public function like_post()
    {
        $sText = $this->post('text');
        $this->load->model("players/Player");
        $oPlayer = new Player();
        $oResponse = $oPlayer->like($sText);

        $this->response([
                'status' => TRUE,
                'message' => 'Controlador implementado correctamente.',
                'body' => $oResponse
            ], 
            REST_Controller::HTTP_OK
        );
    }

    public function create_post()
    {
        $this->load->model("players/Player");
        $oPlayer = new Player();
        
        $iTipo = $this->post('tipo');
        $aStast = $this->post('stast');

        if ($iTipo == 1) {
            $oResponse = $oPlayer->insert_sofifa($aStast);
        }

        $this->response([
                'status' => TRUE,
                'message' => 'Registro exitoso.'
            ], 
            REST_Controller::HTTP_OK
        );
    }

    public function update_post()
    {
        $iId = $this->post('id');
        $sDate = $this->post('date');

        $this->load->model("players/Player");
        $oPlayer = new Player();
        
        $oResponse = $oPlayer->update($iId, $sDate);

        $this->response($oResponse, REST_Controller::HTTP_OK);
    }

    public function check_post()
    {
        $iId = $this->post('id');
        $sDate = $this->post('date');

        $this->load->model("players/Player");
        $oPlayer = new Player();
        $bActualizar = $oPlayer->check($iId, $sDate);

        $this->response([
              'actualizar' => $bActualizar
            ], 
            REST_Controller::HTTP_OK
        );
    }

    public function update_get($iId)
    {
        $this->load->model("players/Player");
        $oPlayer = new Player();
        $oResponse = $oPlayer->update_id($iId);

        $this->response([
              $oResponse
            ], 
            REST_Controller::HTTP_OK
        );
    }
}

 ?>