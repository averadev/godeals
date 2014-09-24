<?php

/**
 * GeekBucket 2014
 * Author: Polanco Alan
 *
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

setlocale(LC_ALL,"es_ES@euro","es_ES","esp");

class Map_category extends CI_Controller {

     public function __construct(){
        parent::__construct();
        $this->load->database('default');
         $this->load->helper('url');
        $this->load->model('map_category_db');
    }
    
    
     public function getAllSearch(){
       
        if($this->input->is_ajax_request()){
            $data = $this->map_category_db->getNameSearch($_POST['dato']);
            echo json_encode($data);
        }
    }
    
}
