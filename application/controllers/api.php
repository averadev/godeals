<?php
setlocale(LC_ALL,"es_ES@euro","es_ES","esp");

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class Api extends REST_Controller {
/**
 * The Saving coupon
 * Author: Alberto Vera Espitia
 * GeekBucket 2014
 *
 */

	public function __construct() {
        parent::__construct();
        $this->load->database('default');
        $this->load->model('user_db');
        $this->load->model('coupon_db');
    }

	public function index_get()
    {
        $this->load->view('web/vwApi');
    }

    /**
     * Obtenemos el registro de un socio
     */
    public function getCoupons_get() { 
        // Verificamos parametros y acceso
        $message = $this->verifyIsSet(array('user', 'key'));
        if ($message == null) { $message = $this->verifyAccess(); }
        if ($message == null) {
            // Obtener cupones
            $data = $this->coupon_db->getAvailable();
            $message = array('success' => true, 'coupons' => $data);
        }
        $this->response($message, 200);
    }
    
    

    // ------------------ METODOS GENERICOS ------------------ //
    /**
     * Verificamos las credenciales de accesso
     */
	private function verifyAccess(){
		$socio = $this->user_db->get(array('user' => $this->get('user'), 'key' => $this->get('key')));
		if (count($socio) == 0){
			return array('success' => false, 'message' => 'El usuario o password es incorrecto');
		}
		return null;
	}

    /**
     * Verificamos si las variables obligatorias fueron enviadas
     */
    private function verifyIsSet($params){
    	foreach ($params as &$value) {
		    if ($this->get($value) ==  '')
		    	return array('success' => false, 'message' => 'El parametro '.$value.' es obligatorio');
		}
		return null;
    }

}