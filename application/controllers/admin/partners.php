<?php
/**
 * GeekBucket 2014
 * Author: Polanco Alan
 *
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

setlocale(LC_ALL,"es_ES@euro","es_ES","esp");

class Partners extends CI_Controller {
 
    public function __construct(){
        parent::__construct();
        $this->load->model('partner_db');
         $this->load->helper('url');
        $this->load->database('default');
    }
    
	public function index($offset = 0){       
        $data['partners'] = $this->partner_db->getNameSearch("an");
        $this->load->view('admin/vwPartners',$data);
            
        }
    
    public function getallSearch(){
       
        if($this->input->is_ajax_request()){
            $data = $this->partner_db->getNameSearch($_POST['dato']);
            echo json_encode($data);
        }
    }
    
}
