<?php
/**
 * GeekBucket 2014
 * Author: Polanco Alan
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
        if (!$this->session->userdata('username')) {
            redirect('admin');
        }
    }

    /**
     * Despliega la pantalla de eventos
     */
    
	public function index($offset = 0){          
        $data['page'] = 'eventos';     
        $data['event'] = $this->sortSliceArray($this->event_db->getAllEvents(),10);//se obtiene los primero 10
		$data['total'] = $this->totalArray($this->event_db->getAllEvents());
        
        $this->load->view('admin/vwEventos',$data);   
	}
	
	/**
     * Obtiene un array sorting and sliced
     */
    public function sortSliceArray($array, $count){
		//slice
        if (count($array) > $count){
            $array = array_slice($array, 0, $count);
        }
        return $array;
    }
	
    public function totalArray($array){
        $array = count($array);
        return $array;
    }
    
    public function getID(){
        if($this->input->is_ajax_request()){
            $data = $this->event_db->get($_POST['id']);
            echo json_encode($data);
        }
    }
	
	public function paginadorArray(){
		if($this->input->is_ajax_request()){
            $data = $this->event_db->getallSearch($_POST['dato'],$_POST['column'],$_POST['order']);
			$array = array_slice($data, $_POST['cantidad'], 10);
            echo json_encode($array);
        }
	}
	
	public function getallSearch(){
		if($this->input->is_ajax_request()){
            $data = $this->event_db->getallSearch($_POST['dato'],$_POST['column'],$_POST['order']);
            echo json_encode($data);
        }
	}
	
	public function saveEvent(){
		if($this->input->is_ajax_request()){
			if($_POST['id'] == 0){
				$insert = array(
   					'name'	 		=> $_POST['name'],
					'eventTypeId' 	=> $_POST['type'],
   					'word' 			=> $_POST['word'],
					'info' 			=> $_POST['info'],
   					'place' 		=> $_POST['place'],
					'idCity' 		=> $_POST['idCity'],
					'date' 			=> $_POST['date'],
					'endDate' 		=> $_POST['endDate'],
					'image' 		=> $_POST['image'],
					'fav' 			=> $_POST['fav'],
					'latitude' 		=> $_POST['latitude'],
					'longitude' 	=> $_POST['longitude'],
					'tags' 			=> $_POST['tags'],
					'status' 		=> 1
				);
				$data = $this->event_db->insertEvent($insert);
				$data = "Se han agregado un nuevo evento";
			} else {
				$update = array(
					'id' 			=> $_POST['id'],
   					'eventTypeId' 	=> $_POST['type'],
   					'word' 			=> $_POST['word'],
					'info' 			=> $_POST['info'],
   					'place' 		=> $_POST['place'],
					'idCity' 		=> $_POST['idCity'],
					'date' 			=> $_POST['date'],
					'endDate' 		=> $_POST['endDate'],
					'image' 		=> $_POST['image'],
					'fav' 			=> $_POST['fav'],
					'latitude' 		=> $_POST['latitude'],
					'longitude' 	=> $_POST['longitude'],
					'tags' 			=> $_POST['tags']
				);
				$data = $this->event_db->updateEvent($update);
				$data = "Se han editado los datos del evento";
			}
            
            echo json_encode($data);
        }
	}
	
	public function deleteEvent(){
		if($this->input->is_ajax_request()){
				$delete = array(
					'id' => $_POST['id'],
   					'status' => 0
				);
				$data = $this->event_db->deleteEvent($delete);
            	echo json_encode($data);
        }
	}
	
	public function subirImagen(){
		$ruta = explode(",",$_POST['ruta']);
		
		if($_POST['nameImage'] != "0"){
			$nombreTimeStamp = $_POST['nameImage'];
		} else {
			$fecha = new DateTime();
        	$nombreTimeStamp = "coupon_" . $fecha->getTimestamp() . ".jpg";
		}
		
		$con = 0;		
  		foreach ($_FILES as $key) {
    		if($key['error'] == UPLOAD_ERR_OK ){//Verificamos si se subio correctamente
      			$nombre = $key['name'];//Obtenemos el nombre del archivo
      			$temporal = $key['tmp_name']; //Obtenemos el nombre del archivo temporal
      			$tamano= ($key['size'] / 1000)."Kb"; //Obtenemos el tamaño en KB
				$tipo = $key['type']; //obtenemos el tipo de imagen
				
				move_uploaded_file($temporal, $ruta[$con] . $nombreTimeStamp);
				
				$con++;
				
    		}else{
    		}
		}
		echo $nombreTimeStamp;
	}
	
	public function deleteImage(){
	}
    
}	
