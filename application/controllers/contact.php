<?php
/**
 * GeekBucket 2014
 * Author: Gengis Cetina
 *
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

setlocale(LC_ALL,"es_ES@euro","es_ES","esp");

require_once('api/EmailManager.php');

class contact extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
    }

    /**
     * Despliega la pantalla de eventos
     */
    public function index(){        
        // Get View
        $this->load->view('web/vwContact');
    }
    
    /**
     * Envia email de contacto
     */
    public function sendEmail(){
        if($this->input->is_ajax_request()){
            // Send email
            $EmailManager = new EmailManager();
            $EmailManager->contactEmail($_POST["name"], $_POST["email"], $_POST["subject"], $_POST["mesage"]);
        }
    }
    
}