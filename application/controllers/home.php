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

class Home extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->database('default');
        $this->load->model('user_db');
        $this->load->model('publicity_db');
        $this->load->model('coupon_db');
        $this->load->model('event_db');
    }

    /**
     * Despliega la pantalla del home
     */
    public function index(){
        // Get data from database
        $data['natMonth'] = array('', 'Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
        $data['banner'] = $this->sortSliceArray($this->publicity_db->getBanners(), 5);
        $data['cupones'] = $this->sortSliceArray($this->coupon_db->getHomeCoupons(), 8);
        $data['timers'] = $this->sortSliceArray($this->coupon_db->getHomeTimers(), 4);
        $data['events'] = $this->sortSliceArray($this->event_db->getFav(), 3);
        $this->load->view('web/vwHome', $data);
    }
    
    /**
     * Obtiene el registro seleccionado
     */
    public function getCoupon(){
        if($this->input->is_ajax_request()){
            $data = $this->coupon_db->get($_POST['id']);
            if (count($data) > 0){
                echo json_encode($data[0]);
            }
        }
    }
    
    /**
     * Obtiene el registro seleccionado
     */
    public function registro(){
        if($this->input->is_ajax_request()){
            $_POST['password'] = md5($_POST['password']);
            $socio = $this->user_db->get(array('email' => $_POST['email']));
            if (count($socio) == 0){
                $this->user_db->insert(array('email' => $_POST['email'], 'password' => $_POST['password'], 'phase' => 0));
                echo json_encode(array('message' => 'Felicidades, ya cuentas con una cuenta en GoDeals.'));
            }else{
                echo json_encode(array('message' => 'El email proporcinado ya se encuentra registrado.'));
            }
            
            
            
        }
    }
    
    /**
     * Obtiene un array sorting and sliced
     */
    public function sortSliceArray($array, $count){
        // Suffle
        shuffle($array);
        // Slice
        if (count($array) > $count){
            $array = array_slice($array, 0, $count);
        }
        return $array;
    }

}