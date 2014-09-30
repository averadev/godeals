<?php
/**
 * ark Admin Panel for Codeigniter 
 * Author: Abhishek R. Kaushik
 * downloaded from http://devzone.co.in
 *
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller {
    
    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');        
        $this->load->model('admin_user_db');

    }

    /**
     * Default
     */
    public function index() {
        if ($this->session->userdata('username')) {
            redirect('admin/dashboard');
        } else {
            $this->load->view('admin/vwLogin');
        }
    }
    
    /**
     * Verificar acceso
     */
    public function login(){
        if($this->input->is_ajax_request()){
            $data = $this->admin_user_db->get(array('username' => $_POST['username'], 'password' => md5($_POST['password'])));
            if (count($data) > 0){
                $this->session->set_userdata(array(
                    'id' => $data[0]->id,
                    'username' => $data[0]->username,
                    'email' => $data[0]->email
                ));
                echo json_encode(array('success' => true, 'message' => 'Acceso satisfactorio.'));
            }else{
                echo json_encode(array('success' => false, 'message' => 'El usuario y/o password es incorrecto.'));
            }
        }
    }
    
    /**
     * Quit session object
     */
    public function logout() {
        $this->session->unset_userdata('id');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('email');
        $this->session->sess_destroy();
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
        redirect('admin');
    }

    

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */