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

class Eventos extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->database('default');
        $this->load->model('event_db');
    }
    
    /**
     * Obtiene las categorias
     */
    public function getEventCategories(){
        if($this->input->is_ajax_request()){
            $data = $this->event_db->getEventCategories($_POST['id']);
            echo json_encode($data);
        }
    }

    /**
     * Despliega la pantalla de eventos
     */
    public function index(){
        // Get data from database
        $data['fav'] = $this->event_db->getFav();
        $data['available'] = $this->event_db->getAvailable();
        // Meses
        $data['month'] = array('', 'ENERO','FEBRERO','MARZO','ABRIL','MAYO','JUNIO','JULIO','AGOSTO','SEPTIEMBRE','OCTUBRE','NOVIEMBRE','DICIEMBRE');
        $data['natMonth'] = array('', 'Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
        $data['minMonth'] = array('', 'ENE','FEB','MAR','ABR','MAY','JUN','JUL','AGO','SEP','OCT','NOV','DIC');
        // Get Months
        $curMonth = -1;
        $lastMonth = -1;
        $months = array();
        foreach ($data['available'] as $item):
            $curMonth = date('n', strtotime($item->date));
            if ($curMonth != $lastMonth){ 
                    array_push($months, $data['minMonth'][$curMonth]);
            }
            $lastMonth = $curMonth;
        endforeach;
        $data['months'] = $months;
        // Get View
        $this->load->view('web/vwEventos', $data);
    }
    

}