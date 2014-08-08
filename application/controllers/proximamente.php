<?php
/**
 * GeekBucket 2014
 * Author: Alberto Vera Espitia
 * Define el comportamiento de home en la web publica
 *
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

setlocale(LC_ALL,"es_ES@euro","es_ES","esp");

require_once('api/EmailManager.php');

class Proximamente extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->database('default');
        $this->load->model('user_db');
    }

    /**
     * Despliega la pantalla del home
     */
    public function index(){
        $this->load->view('web/vwProximamente');
    }
    
    /**
     * Obtiene el registro seleccionado
     */
    public function registro(){
        if($this->input->is_ajax_request()){
            $password = md5($_POST['password']);
            $socio = $this->user_db->get(array('email' => $_POST['email']));
            if (count($socio) == 0){
                $this->user_db->insert(array('email' => $_POST['email'], 'password' => $password, 'phase' => 0));
                echo json_encode(array('message' => 'Felicidades, ya cuentas con una cuenta en GoDeals.'));
                // Send email
                $EmailManager = new EmailManager();
                $EmailManager->preRegisterEmail($_POST['email'], $_POST['password']);
            }else{
                echo json_encode(array('message' => 'El email proporcinado ya se encuentra registrado.'));
            }
        }
    }

}