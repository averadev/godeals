<?php
/**
 * GeekBucket 2014
 * Author: Gengis Cetina
 *
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

setlocale(LC_ALL,"es_ES@euro","es_ES","esp");

class Faq extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
    }

    /**
     * Despliega la pantalla de eventos
     */
    public function index(){        
        // Get View
        $this->load->view('web/vwFaq');
    }
}