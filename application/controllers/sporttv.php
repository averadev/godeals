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

class Sporttv extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->database('default');
        $this->load->model('sporttv_db');
    }

    /**
     * Despliega la pantalla de eventos
     */
    public function index(){
        // Get available dates
        $data['dates'] = $this->sporttv_db->getDates();
        // Get available events by date
        foreach ($data['dates'] as $item):
            $item->events = $this->sporttv_db->getEventDate($item->date);
             // Get available bars by event
            for ($i = 0; $i < count($item->events); $i++) {
                $item->events[$i]->bars = $this->sporttv_db->getEventBar($item->events[$i]->id);
            }
        endforeach;
       
        // Meses
        $data['minMonth'] = array('', 'ENE','FEB','MAR','ABR','MAY','JUN','JUL','AGO','SEP','OCT','NOV','DIC');
        
        // Get View
        $this->load->view('web/vwSporttv', $data);
    }
    

}