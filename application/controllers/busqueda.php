<?php
/**
 * GeekBucket 2014
 * Author: Alberto Vera Espitia
 * Define el comportamiento de cupones en la web publica
 *
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

setlocale(LC_ALL,"es_ES@euro","es_ES","esp");

class Busqueda extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->database('default');
        $this->load->model('catalogo_db');
        $this->load->model('coupon_db');
        $this->load->model('publicity_db');
    }

    /**
     * Despliega la pantalla del home
     */
    public function index(){
        // Get View
        $this->load->view('web/vwProductos', $data);
    }
    
    /**
     * Despliega la pantalla de eventos
     */
    public function c($id){
        // Publicidad
        $data['medioBanner'] = $this->sortSliceArray($this->publicity_db->getPublicidad(2), 2);
        $data['lateral'] = $this->publicity_db->getPublicidad(3);
        shuffle($data['lateral']);
        $data['cintillo'] = $this->publicity_db->getPublicidad(4);
        shuffle($data['cintillo']);
        
        // Cupones
        $data['elements'] = array();
        $data['coupons'] = $this->coupon_db->getByPartner($id);
        $data['total'] = count($data['coupons']);
        $data['todas'] = $data['total'];
        $data['sel'] = 0;
        
        // Sort array
        shuffle($data['coupons']);
        
        // Get View
        $this->load->view('web/vwProductos', $data);
    }
    
    /**
     * Despliega la pantalla de eventos
     */
    public function p($id){
        // Publicidad
        $data['medioBanner'] = $this->sortSliceArray($this->publicity_db->getPublicidad(2), 2);
        $data['lateral'] = $this->publicity_db->getPublicidad(3);
        shuffle($data['lateral']);
        $data['cintillo'] = $this->publicity_db->getPublicidad(4);
        shuffle($data['cintillo']);
        
        // Cupones
        $data['elements'] = array();
        $data['coupons'] = $this->coupon_db->getByPlace($id);
        $data['total'] = count($data['coupons']);
        $data['todas'] = $data['total'];
        $data['sel'] = 0;
        
        // Sort array
        shuffle($data['coupons']);
        
        // Get View
        $this->load->view('web/vwProductos', $data);
    }
    
    /**
     * Despliega la pantalla de eventos
     */
    public function s($text){
        $text = urldecode($text);
        // Publicidad
        $data['medioBanner'] = $this->sortSliceArray($this->publicity_db->getPublicidad(2), 2);
        $data['lateral'] = $this->publicity_db->getPublicidad(3);
        shuffle($data['lateral']);
        $data['cintillo'] = $this->publicity_db->getPublicidad(4);
        shuffle($data['cintillo']);
        
        // Cupones
        $data['elements'] = array();
        $data['coupons'] = $this->coupon_db->getByTxt($text);
        $data['total'] = count($data['coupons']);
        $data['todas'] = $data['total'];
        $data['sel'] = 0;
        
        // Sort array
        shuffle($data['coupons']);
        
        // Get View
        $this->load->view('web/vwProductos', $data);
    }
    
    /**
     * Obtiene un array sorting and sliced
     */
    public function sortSliceArray($array, $count){
        shuffle($array);
        if (count($array) > $count){
            $array = array_slice($array, 0, $count);
        }
        return $array;
    }

}