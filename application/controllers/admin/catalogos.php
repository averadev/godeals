<?php
/**
 * GeekBucket 2014
 * Author: Polanco Alan
 *
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

setlocale(LC_ALL,"es_ES@euro","es_ES","esp");

class Catalogos extends CI_Controller {

     public function __construct(){
        parent::__construct();
        $this->load->database('default');
        $this->load->helper('url');
        $this->load->model('city_db');
        $this->load->model('event_db');
        $this->load->model('map_category_db');
    }
    
    public function getCities(){
        if($this->input->is_ajax_request()){
            $data = $this->city_db->getNameSearch($_POST['dato']);
            echo json_encode($data);
        }
    }
    
    public function getEventType(){
        if($this->input->is_ajax_request()){
            $data = $this->event_db->getAllCategories($_POST['dato']);
            echo json_encode($data);
        }
    }
    
    public function getMapCategories(){
        if($this->input->is_ajax_request()){
            $data = $this->map_category_db->getNameSearch($_POST['dato']);
            echo json_encode($data);
        }
    }
    
}