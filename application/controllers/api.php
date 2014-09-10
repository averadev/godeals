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
        $this->load->model('api_db');
        $this->load->model('place_db');
        $this->load->model('sporttv_db');
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
        $message = $this->verifyIsSet(array('email'));
        if ($message == null) { $message = $this->verifyAccess(); }
        if ($message == null) {
            // Obtener cupones
            $data = $this->coupon_db->getAvailable();
            $message = array('success' => true, 'coupons' => $data);
        }
        $this->response($message, 200);
    }

    /**
     * Crear Usuario
     */
    public function createUser_get() { 
        // Verificamos parametros y acceso
        $message = $this->verifyIsSet(array('email'));
        if ($message == null) {
            // Obtener cupones
            if ($this->get('fbId') == ''){
                $data = $this->user_db->verifyEmail($this->get('email'));
                if (count($data) > 0){
                    $message = array('success' => false, 'message' => 'El email ya esta registrado.');
                }else{
                    $this->user_db->insert(array('email' => $this->get('email'), 'password' => $this->get('password')));
                    $message = array('success' => true, 'message' => 'El usuario fue registrado exitosamente');
                }
            }else{
                // Usuario de FaceBook
                $data = $this->user_db->verifyEmail($this->get('email'));
                if (count($data) > 0){
                    $this->user_db->update(array('email' => $this->get('email'), 'name' => $this->get('name'), 'fbId' => $this->get('fbId')));
                }else{
                    $this->user_db->insert(array('email' => $this->get('email'), 'name' => $this->get('name'), 'fbId' => $this->get('fbId')));
                }
                $message = array('success' => true, 'message' => 'El usuario fue registrado exitosamente');
            }
        }
        $this->response($message, 200);
    }
    
    /**
     * Crear Usuario
     */
    public function validateUser_get() { 
        // Verificamos parametros y acceso
        $message = $this->verifyIsSet(array('email'));
        if ($message == null) {
            // Obtener cupones
            $data = $this->user_db->verifyEmailPass($this->get('email'), $this->get('password'));
            if (count($data) > 0){
                $message = array('success' => true, 'message' => 'Usuario correcto');
            }else{
                $message = array('success' => false, 'message' => 'El usuario/password es incorrecto.');
            }
        }
        $this->response($message, 200);
    }
    
    /**
     * Obtener items
     */
    public function getServices_get() { 
        // Verificamos parametros y acceso
        $message = $this->verifyIsSet(array('email'));
        // Verificamos credenciales
        if ($message == null) { $message = $this->verifyAccess(); }
        if ($message == null) {
            // Obtener servicios
            $items = $this->api_db->getServices();
            $message = array('success' => true, 'items' => $items);
        }
        $this->response($message, 200);
    }

    /**
     * Obtener items
     */
    public function getItems_get() { 
        // Verificamos parametros y acceso
        $minMonths = array('', 'ENE','FEB','MAR','ABR','MAY','JUN','JUL','AGO','SEP','OCT','NOV','DIC');
        $months = array('', 'Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
        $message = $this->verifyIsSet(array('email', 'type'));
        // Verificamos credenciales
        if ($message == null) { $message = $this->verifyAccess(); }
        if ($message == null) {
            // Obtener todos
            if ($this->get('type') == 1){
                // Get alls
                $eventFav = $this->api_db->getEventFav();
                $events = $this->api_db->getEventNoFav();
                $coupons = $this->api_db->getCoupon(1);
                $place = $this->api_db->getPlace();
                $sporttv = $this->api_db->getSporttv();
                
                // Set extra data
                foreach ($eventFav as $item):
                    // Add new vars
                    $item->fav = 1;
                    $item->type = 2;
                    $item->dateMin = date('d', strtotime($item->date)) . '/' . $minMonths[date('n', strtotime($item->date))];
                    $item->dateMax = date('d', strtotime($item->date)) . ' de ' . $months[date('n', strtotime($item->date))];
                    $item->path = 'event/app/';
                endforeach;
                foreach ($events as $item):
                    // Add new vars
                    $item->fav = 0;
                    $item->type = 2;
                    $item->dateMin = date('d', strtotime($item->date)) . '/' . $minMonths[date('n', strtotime($item->date))];
                    $item->dateMax = date('d', strtotime($item->date)) . ' de ' . $months[date('n', strtotime($item->date))];
                    $item->path = 'event/app/';
                endforeach;
                foreach ($coupons as $item):
                    $item->fav = 0;
                    $item->type = 3;
                    $item->path = 'coupon/app/';
                    $item->subtitle1 = $item->partnerName.' en '.$item->cityName;
                endforeach;
                foreach ($place as $item):
                    $item->fav = 1;
                    $item->type = 5;
                    $item->path = 'visita/app/';
                    $item->title = ucwords(strtolower($item->title));
                    $item->subtitle1 = "Disfruta de " . $item->subtitle1;
                    $item->bars = $this->place_db->getBars($item->id);
                    $item->hotels = $this->place_db->getHotels($item->id);
                    $item->restaurants = $this->place_db->getRestaurants($item->id);
                endforeach;
                foreach ($sporttv as $item):
                    $item->fav = 1;
                    $item->type = 6;
                    $item->path = 'sporttv/app/';
                    $item->subtitle2 = date('d', strtotime($item->date)) . ' de ' . $months[date('n', strtotime($item->date))] . ' - ' . $item->time;
                    $item->bars = $this->sporttv_db->getEventBar($item->id);
                    unset($item->date);
                    unset($item->time);
                endforeach;
                
                // Merge big size 
                $bigs = array_merge($eventFav, $place, $sporttv);
                $small = array_merge($events, $coupons);
                // Sort Items
                shuffle($bigs);
                shuffle($small);
                
                // Order items
                $items = array();
                while (count($bigs) > 0):
                    $items = array_merge($items, array_slice($bigs, 0, 2));
                    array_splice($bigs, 0, 2);
                    if (count($small) > 0){
                        $items = array_merge($items, array_slice($small, 0, 8));
                        array_splice($small, 0, 8);
                    }
                endwhile;
                // Agregar a la cola los small restantes
                if (count($small) > 0){
                    $items = array_merge($items, $small);
                }
                
                // Return items
                $message = array('success' => true, 'items' => $items);
            } 
            // Obtener Adondeir
            elseif ($this->get('type') == 2){
                // Get alls
                $items = $this->api_db->getEvent();
                $fav = $this->api_db->getEventFav();
                // Set time line    
                foreach ($items as $item):
                    $item->fav = 0;
                endforeach;
                // Merge arrays
                $data = array_merge(
                    $fav, 
                     $items);
                // Complete Subtitle
                foreach ($data as $item):
                    // Add new vars
                    $item->type = 2;
                    $item->dateMin = date('d', strtotime($item->date)) . '/' . $minMonths[date('n', strtotime($item->date))];
                    $item->dateMax = date('d', strtotime($item->date)) . ' de ' . $months[date('n', strtotime($item->date))];
                    $item->path = 'event/app/';
                endforeach;
                $message = array('success' => true, 'items' => $data);
            } 
            // Obtener Adondeir
            elseif ($this->get('type') == 3 or $this->get('type') == 4){
                // Get alls
                $type = ($this->get('type') == 3)?1:2;
                $submenu = $this->api_db->getSubmenu($type);
                // Obtenemos por tipo y subtipo
                $items;
                if ($this->get('subtype') !=  ''){
                    $items = $this->api_db->getCouponSubType($this->get('subtype'));
                }else{
                    $items = $this->api_db->getCoupon($type);
                } 
                
                shuffle($items);
                $count = 0;
                foreach ($items as $item):
                    ++$count;
                    $item->fav = ($count%10==1 || $count%10==2)?1:0;
                    $item->type = ($this->get('type') == 3)?3:4;
                    $item->path = 'coupon/app/';
                    $item->subtitle1 = $item->partnerName.' en '.$item->cityName;
                endforeach;
                $message = array('success' => true, 'submenu' => $submenu, 'items' => $items);
            }
            // Obtener Adondeir
            elseif ($this->get('type') == 5){
                // Get alls
                $items = $this->api_db->getPlace();
                shuffle($items);
                foreach ($items as $item):
                    $item->fav = 1;
                    $item->type = 5;
                    $item->path = 'visita/app/';
                    $item->title = ucwords(strtolower($item->title));
                    $item->subtitle1 = "Disfruta de " . $item->subtitle1;
                    $item->bars = $this->place_db->getBars($item->id);
                    $item->hotels = $this->place_db->getHotels($item->id);
                    $item->restaurants = $this->place_db->getRestaurants($item->id);
                endforeach;
                $message = array('success' => true, 'items' => $items);
            }
            // Obtener Sport TV
            elseif ($this->get('type') == 6){
                // Get alls
                $items = $this->api_db->getSporttv();
                foreach ($items as $item):
                    $item->fav = 1;
                    $item->type = 6;
                    $item->path = 'sporttv/app/';
                    $item->subtitle2 = date('d', strtotime($item->date)) . ' de ' . $months[date('n', strtotime($item->date))] . ' - ' . $item->time;
                    $item->bars = $this->sporttv_db->getEventBar($item->id);
                    unset($item->date);
                    unset($item->time);
                endforeach;
                $message = array('success' => true, 'items' => $items);
            }
        }
        $this->response($message, 200);
    }
    
    

    // ------------------ METODOS GENERICOS ------------------ //
    /**
     * Verificamos las credenciales de accesso
     */
	private function verifyAccess(){
		$socio = $this->user_db->get(array('email' => $this->get('email')));
		if (count($socio) == 0){
			return array('success' => false, 'message' => 'El usuario es incorrecto');
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