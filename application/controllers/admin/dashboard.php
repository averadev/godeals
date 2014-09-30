<?php
/**
 * ark Admin Panel for Codeigniter 
 * Author: Abhishek R. Kaushik
 * downloaded from http://devzone.co.in
 *
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    
    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');        
        $this->load->model('admin_user_db');
        if (!$this->session->userdata('username')) {
            redirect('admin');
        }
    }

    /**
     * Default
     */
    public function index() {
        $this->load->view('admin/vwDashboard');
    }
    

}