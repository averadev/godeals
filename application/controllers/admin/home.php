<?php
/**
 * GeekBucket 2014
 * Author: Alberto Vera Espitia
 * Define el comportamiento del Dashboard en la app
 *
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

setlocale(LC_ALL,"es_ES@euro","es_ES","esp");


class Home extends CI_Controller {

    public function __construct(){
        parent::__construct();
    }

    
    /**
     * Despliega la pantalla del dashboard
     */
    public function index(){
        $this->load->view('app/vwHome');
    }
    
    

    /**
     * Obtiene el registro seleccionado
     */
    public function getHello(){
        if($this->input->is_ajax_request()){
            $data = array('mensaje'=>"Hello");
            echo json_encode($data);
        }
    }
    

}