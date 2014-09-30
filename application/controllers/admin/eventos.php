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
   					'name' => $_POST['name'],
   					'word' => $_POST['word'],
   					'place' => $_POST['place'],
					'idCity' => $_POST['idCity'],
					'date' => $_POST['date'],
					'image' => $_POST['image'],
					'fav' => $_POST['fav'],
					'status' => 1
				);
				$data = $this->event_db->insertEvent($insert);
			} else {
				$update = array(
					'id' => $_POST['id'],
   					'name' => $_POST['name'],
   					'word' => $_POST['word'] ,
   					'place' => $_POST['place'],
					'idCity' => $_POST['idCity'],
					'date' => $_POST['date'],
					'image' => $_POST['image'],
					'fav' => $_POST['fav']
				);
				$data = $this->event_db->updateEvent($update);
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
	
	public function uploadImage(){
		$rutaMax="assets/img/app/event/max/";
		$rutaMed="assets/img/app/event/med/";
		$rutaMin="assets/img/app/event/min/";
  		foreach ($_FILES as $key) {
    		if($key['error'] == UPLOAD_ERR_OK ){//Verificamos si se subio correctamente
      			$nombre = $key['name'];//Obtenemos el nombre del archivo
      			$temporal = $key['tmp_name']; //Obtenemos la dirrecion del archivo
      			$tamano= ($key['size'] / 1000)."Kb"; //Obtenemos el tamaño en KB
				$tipo = $key['type']; //obtenemos el tipo de imagen
				
				//definimos el ancho y alto que tendra la imagen
				$max_ancho = 1024;
				$max_alto = 700;
				$med_ancho = 250;
				$med_alto = 437;
				$min_ancho = 320;
				$min_alto = 280;
				list($ancho,$alto)=getimagesize($temporal);
				//Creamos una imagen en blanco con el ancho y alto final
				$tmpMax=imagecreatetruecolor($max_ancho,$max_alto);
				$tmpMed=imagecreatetruecolor($med_ancho,$med_alto);
				$tmpMin=imagecreatetruecolor($min_ancho,$min_alto);	
				
				//detecta si la imagen es png
				if($tipo == "image/png"){
					//toma la ruta de la imagen
					$imagen = imagecreatefrompng($temporal); 
				//detecta si la imagen es tipo gif 	
				} else if($tipo == "image/gif"){ 
					$imagen = imagecreatefromgif($temporal);	
				} else {
					//move_uploaded_file($temporal, $ruta . "a.jpg"); //Movemos el archivo temporal a la ruta especificada
					$imagen = imagecreatefromjpeg($temporal); 
				}
					$fecha = new DateTime();
					$nombreTimeStamp = $fecha->getTimestamp();
				
				//toma la ruta de la imagen a crear
					$patch_imagenMax=$rutaMax . "event_" . $nombreTimeStamp .".jpg";
					$patch_imagenMed=$rutaMed . "event_" . $nombreTimeStamp . ".jpg";
					$patch_imagenMin=$rutaMin . "event_" . $nombreTimeStamp . ".jpg";
				
				//Copiamos la imagen sobre la imagen que acabamos de crear en blanco
					imagecopyresampled($tmpMax,$imagen,0,0,0,0,$max_ancho, $max_alto,$ancho,$alto);
					imagejpeg($tmpMax,$patch_imagenMax,100);
					
					imagecopyresampled($tmpMed,$imagen,0,0,0,0,$med_ancho, $med_alto,$ancho,$alto);
					imagejpeg($tmpMed,$patch_imagenMed,100);
					
					imagecopyresampled($tmpMin,$imagen,0,0,0,0,$min_ancho, $min_alto,$ancho,$alto);
					imagejpeg($tmpMin,$patch_imagenMin,100);
	
					//Se destruye variable $img_original para liberar memoria
					imagedestroy($imagen);
      			
				//echo json_encode($_FILES);
				
					echo "event_" . $nombreTimeStamp . ".jpg";
				
    		}else{
				
    		}
		}
	}
	
	public function deleteImage(){
		if($this->input->is_ajax_request()){
            $rutaMax="assets/img/app/event/max/";
			$rutaMed="assets/img/app/event/med/";
			$rutaMin="assets/img/app/event/min/";
			unlink($rutaMax . $_POST['deleteImage']);
			unlink($rutaMed . $_POST['deleteImage']);
			unlink($rutaMin . $_POST['deleteImage']);
        }
	}
    
}	
