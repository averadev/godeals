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
        $this->load->model('publicity_db');
    }

	public function index_get()
    {
        $this->load->view('web/vwApi');
    }

    /**
     * Test connection
     */
    public function test_get() { 
        $this->response(array('success' => true), 200);
    }

    /**
     * Regresamos publicidad
     */
    public function publicidad_get() { 
        redirect('/assets/img/app/publicidad.png', 'location');
    }

    /**
     * Obtenemos el registro de un socio
     */
    public function getCoupons_get() { 
        // Verificamos parametros y acceso
        $message = $this->verifyIsSet(array('idApp'));
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
        $message = null;
        if ($message == null) {
            // Obtener cupones
            if ($this->get('fbId') == ''){
                $data = $this->user_db->verifyEmail($this->get('email'));
                if (count($data) > 0){
                    $message = array('success' => false, 'message' => 'El email ya fue registrado anteriormente.');
                }else{
                    $idApp = $this->user_db->insert(array('email' => $this->get('email'), 'password' => $this->get('password')));
                    $message = array('success' => true, 'idApp' => $idApp, 'message' => 'El usuario fue registrado exitosamente');
                }
            }else{
                // Usuario de FaceBook
                $data = $this->user_db->verifyEmail($this->get('email'));
                if (count($data) > 0){
                    $this->user_db->update(array('email' => $this->get('email'), 'name' => $this->get('name'), 'fbId' => $this->get('fbId')));
                    $message = array('success' => true, 'idApp' => $data[0]->id, 'message' => 'El usuario fue registrado exitosamente');
                }else{
                    $idApp = $this->user_db->insert(array('email' => $this->get('email'), 'name' => $this->get('name'), 'fbId' => $this->get('fbId')));
                    $message = array('success' => true, 'idApp' => $idApp, 'message' => 'El usuario fue registrado exitosamente');
                }
            }
        }
        $this->response($message, 200);
    }
    
    /**
     * Crear Usuario
     */
    public function validateUser_get() { 
        // Verificamos parametros y acceso
        $message = $this->verifyIsSet(array('idApp'));
        if ($message == null) {
            // Obtener cupones
            $data = $this->user_db->verifyEmailPass($this->get('email'), $this->get('password'));
            if (count($data) > 0){
                $message = array('success' => true, 'message' => 'Usuario correcto');
            }else{
                $message = array('success' => false, 'message' => 'El usuario o password es incorrecto.');
            }
        }
        $this->response($message, 200);
    }
    
    /**
     * Obtener items
     */
    public function getDirectory_get() { 
        // Verificamos parametros y acceso
        $message = $this->verifyIsSet(array('idApp'));
        // Verificamos credenciales
        if ($message == null) { $message = $this->verifyAccess(); }
        if ($message == null) {
            // Obtenemos datos
            $items = $this->api_db->getDirectory();
            $message = array('success' => true, 'items' => $items);
        }
        $this->response($message, 200);
    }
    
    /**
     * Obtener items
     */
    public function getSubmenus_get() { 
        // Verificamos parametros y acceso
        $message = $this->verifyIsSet(array('idApp'));
        // Verificamos credenciales
        if ($message == null) { $message = $this->verifyAccess(); }
        if ($message == null) {
            // Obtenemos datos
            $directory = $this->api_db->getDirectoryType();
            foreach ($directory as $item): $item->type = 'Rest'; endforeach;
            array_unshift($directory, array('id' => 0, 'name' => "Todo", 'type' => "Rest"));
            
            $couponType1 = $this->api_db->getCouponType(1);
            foreach ($couponType1 as $item): $item->type = 'Coupon'; endforeach;
            array_unshift($couponType1, array('id' => 0, 'name' => "Todo", 'type' => "Coupon"));
            
            $couponType2 = $this->api_db->getCouponType(2);
            foreach ($couponType2 as $item): $item->type = 'Coupon'; endforeach;
            array_unshift($couponType2, array('id' => 0, 'name' => "Todo", 'type' => "Coupon"));
            
            
            $message = array('success' => true, 
                             'directoryType' => $directory, 
                             'couponType1' => $couponType1, 
                             'couponType2' => $couponType2);
        }
        $this->response($message, 200);
    }
    
    /**
     * Obtener items
     */
    public function getFav_get() { 
        // Verificamos parametros y acceso
        $message = $this->verifyIsSet(array('idApp'));
        // Verificamos credenciales
        if ($message == null) { $message = $this->verifyAccess(); }
        if ($message == null) {
            // Obtenemos datos
            $idApp = $this->get('idApp');
            $events = $this->api_db->getEvent($idApp, true);
            $coupons = $this->api_db->getCoupon($idApp, true, 1);
            $place = $this->api_db->getPlace($idApp, true);
            $sporttv = $this->api_db->getSporttv($idApp, true);
            
            // Arreglos
            $publicidad = $this->publicity_db->getPublicidad(5);
            $minMonths = array('', 'ENE','FEB','MAR','ABR','MAY','JUN','JUL','AGO','SEP','OCT','NOV','DIC');
            $months = array('', 'Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
            
            // Set extra data
            foreach ($events as $item):
                // Add new vars
                $item->fav = 1;
                $item->type = 2;
                $item->dateMin = date('d', strtotime($item->date)) . '/' . $minMonths[date('n', strtotime($item->date))];
                $item->dateMax = date('d', strtotime($item->date)) . ' de ' . $months[date('n', strtotime($item->date))];
                $item->path = 'event/app/';
                $item->publicidad = $publicidad[array_rand($publicidad, 1)]->image;
            endforeach;
            foreach ($coupons as $item):
                $item->fav = 1;
                $item->type = 3;
                $item->path = 'coupon/app/';
                $item->subtitle1 = $item->partnerName.', '.$item->cityName;
                $item->publicidad = $publicidad[array_rand($publicidad, 1)]->image;
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
                $item->publicidad = $publicidad[array_rand($publicidad, 1)]->image;
            endforeach;
            foreach ($sporttv as $item):
                $item->fav = 1;
                $item->type = 6;
                $item->path = 'sporttv/app/';
                $item->subtitle2 = date('d', strtotime($item->date)) . ' de ' . $months[date('n', strtotime($item->date))] . ' - ' . $item->time;
                $item->bars = $this->sporttv_db->getEventBar($item->id);
                $item->publicidad = $publicidad[array_rand($publicidad, 1)]->image;
                unset($item->date);
                unset($item->time);
            endforeach;
            
            // Merge items
            $items = array_merge($events, $coupons, $place, $sporttv);
            $message = array('success' => true, 'items' => $items);
        }
        $this->response($message, 200);
    }
    
    /**
     * Obtener items
     */
    public function setFav_get() { 
        // Verificamos parametros y acceso
        $message = $this->verifyIsSet(array('idApp', 'couponId', 'typeId'));
        // Verificamos credenciales
        if ($message == null) { $message = $this->verifyAccess(); }
        if ($message == null) {
            $obj = array('userId' => $this->get('idApp'), 'couponId' => $this->get('couponId'), 'typeId' => $this->get('typeId'));
            if ($this->get('status') == '1'){
                $items = $this->api_db->insertFav($obj);
                $message = array('success' => true, 'message' => 'Se agrego el fav.');
            }else{
                $items = $this->api_db->removeFav($obj);
                $message = array('success' => true, 'message' => 'Se elimino el fav.');
            }
        }
        $this->response($message, 200);
    }
    
    /**
     * Obtener items
     */
    public function getServices_get() { 
        // Verificamos parametros y acceso
        $message = $this->verifyIsSet(array('idApp'));
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
        $message = $this->verifyIsSet(array('idApp', 'type'));
        // Arreglos
        $publicidad = $this->publicity_db->getPublicidad(5);
        $minMonths = array('', 'ENE','FEB','MAR','ABR','MAY','JUN','JUL','AGO','SEP','OCT','NOV','DIC');
        $months = array('', 'Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
        // Verificamos credenciales
        if ($message == null) { $message = $this->verifyAccess(); }
        if ($message == null) {
            // Id usuario
            $idApp = $this->get('idApp');
            // Obtener todos
            if ($this->get('type') == 1){
                // Get alls
                $eventFav = $this->api_db->getEventFav($idApp);
                $events = $this->api_db->getEventNoFav($idApp);
                $coupons = $this->api_db->getCoupon($idApp, false, 1);
                $place = $this->api_db->getPlace($idApp, false);
                $sporttv = $this->api_db->getSporttv($idApp, false);
                
                // Set extra data
                foreach ($eventFav as $item):
                    // Add new vars
                    $item->fav = 1;
                    $item->type = 2;
                    $item->dateMin = date('d', strtotime($item->date)) . '/' . $minMonths[date('n', strtotime($item->date))];
                    $item->dateMax = date('d', strtotime($item->date)) . ' de ' . $months[date('n', strtotime($item->date))];
                    $item->path = 'event/app/';
                    $item->publicidad = $publicidad[array_rand($publicidad, 1)]->image;
                endforeach;
                foreach ($events as $item):
                    // Add new vars
                    $item->fav = 0;
                    $item->type = 2;
                    $item->dateMin = date('d', strtotime($item->date)) . '/' . $minMonths[date('n', strtotime($item->date))];
                    $item->dateMax = date('d', strtotime($item->date)) . ' de ' . $months[date('n', strtotime($item->date))];
                    $item->path = 'event/app/';
                    $item->publicidad = $publicidad[array_rand($publicidad, 1)]->image;
                endforeach;
                foreach ($coupons as $item):
                    $item->fav = 0;
                    $item->type = 3;
                    $item->path = 'coupon/app/';
                    $item->subtitle1 = $item->partnerName.', '.$item->cityName;
                    $item->publicidad = $publicidad[array_rand($publicidad, 1)]->image;
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
                    $item->publicidad = $publicidad[array_rand($publicidad, 1)]->image;
                endforeach;
                foreach ($sporttv as $item):
                    $item->fav = 1;
                    $item->type = 6;
                    $item->path = 'sporttv/app/';
                    $item->subtitle2 = date('d', strtotime($item->date)) . ' de ' . $months[date('n', strtotime($item->date))] . ' - ' . $item->time;
                    $item->bars = $this->sporttv_db->getEventBar($item->id);
                    $item->publicidad = $publicidad[array_rand($publicidad, 1)]->image;
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
                $items = $this->api_db->getEvent($idApp, false);
                $fav = $this->api_db->getEventFav($idApp);
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
                    $item->publicidad = $publicidad[array_rand($publicidad, 1)]->image;
                endforeach;
                $message = array('success' => true, 'items' => $data);
            } 
            // Obtener Adondeir
            elseif ($this->get('type') == 3 or $this->get('type') == 4){
                // Get alls
                $type = ($this->get('type') == 3)?1:2;
                // Obtenemos por tipo y subtipo
                $items;
                if ($this->get('subtype') !=  ''){
                    $items = $this->api_db->getCouponSubType($idApp, $this->get('subtype'));
                }else{
                    $items = $this->api_db->getCoupon($idApp, false, $type);
                } 
                
                shuffle($items);
                $count = 0;
                foreach ($items as $item):
                    ++$count;
                    $item->fav = ($count%10==1 || $count%10==2)?1:0;
                    $item->type = ($this->get('type') == 3)?3:4;
                    $item->path = 'coupon/app/';
                    $item->subtitle1 = $item->partnerName.', '.$item->cityName;
                    $item->publicidad = $publicidad[array_rand($publicidad, 1)]->image;
                endforeach;
                $message = array('success' => true, 'items' => $items);
            }
            // Obtener Adondeir
            elseif ($this->get('type') == 5){
                // Get alls
                $items = $this->api_db->getPlace($idApp, false);
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
                    $item->publicidad = $publicidad[array_rand($publicidad, 1)]->image;
                endforeach;
                $message = array('success' => true, 'items' => $items);
            }
            // Obtener Sport TV
            elseif ($this->get('type') == 6){
                // Get alls
                $items = $this->api_db->getSporttv($idApp, false);
                foreach ($items as $item):
                    $item->fav = 1;
                    $item->type = 6;
                    $item->path = 'sporttv/app/';
                    $item->subtitle2 = date('d', strtotime($item->date)) . ' de ' . $months[date('n', strtotime($item->date))] . ' - ' . $item->time;
                    $item->bars = $this->sporttv_db->getEventBar($item->id);
                    $item->publicidad = $publicidad[array_rand($publicidad, 1)]->image;
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
		/*$socio = $this->user_db->get(array('email' => $this->get('email')));
		if (count($socio) == 0){
			return array('success' => false, 'message' => 'El usuario es incorrecto');
		}*/
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