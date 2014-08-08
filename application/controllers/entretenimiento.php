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

class Entretenimiento extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->database('default');
        $this->load->model('catalogo_db');
        $this->load->model('coupon_db');
    }

    /**
     * Despliega la pantalla del home
     */
    public function index(){
        // Get data from database
        $data['elements'] = $this->catalogo_db->getAllCatalog(2);
        $data['coupons'] = $this->coupon_db->getByType(2);
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
    public function c($categorie){
        // Get data from database
        $data['elements'] = $this->catalogo_db->getAllCatalog(2);
        $data['coupons'] = $this->coupon_db->getByTypeCat(2, $categorie);
        $data['total'] = count($data['coupons']);
        $data['todas'] = count($this->coupon_db->getByType(2));
        $data['sel'] = $categorie;
        
        // Sort array
        shuffle($data['coupons']);
        
        $this->load->view('web/vwProductos', $data);
    }
    

}