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

class Adondeir extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->database('default');
        $this->load->model('place_db');
    }

    /**
     * Despliega la pantalla de eventos
     */
    public function index(){
        // Get data from database
        $data['sel'] = 0;
        $data['destinos'] = $this->place_db->getAll();
        foreach ( $data['destinos'] as $item):
            $item->banner = $this->place_db->getBanners($item->id);
            $item->transport = $this->place_db->getTransport($item->id);
        endforeach;
        // Menus
        $data['categoria1'] = $this->place_db->getPlaceType(1);
        $data['categoria2'] = $this->place_db->getPlaceType(2);
        
        // Get View
        $this->load->view('web/vwAdondeir', $data);
    }
    
    /**
     * Despliega la pantalla de eventos
     */
    public function c($id){
        // Get data from database
        $data['sel'] = $id;
        $data['destinos'] = $this->place_db->getByType($id);
        foreach ( $data['destinos'] as $item):
            $item->banner = $this->place_db->getBanners($item->id);
            $item->transport = $this->place_db->getTransport($item->id);
        endforeach;
        // Menus
        $data['categoria1'] = $this->place_db->getPlaceType(1);
        $data['categoria2'] = $this->place_db->getPlaceType(2);
        
        // Get View
        $this->load->view('web/vwAdondeir', $data);
    }
    
    /**
     * Despliega la pantalla de eventos
     */
    public function destino($id){
        // Get data from database
        $data['destino'] = $this->place_db->get($id)[0];
        $data['photos'] = $this->place_db->getPhotos($id);
        
        // Get View
        $this->load->view('web/vwDestino', $data);
    }
    

}