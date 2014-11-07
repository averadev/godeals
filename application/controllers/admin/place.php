<?php
/**
 * GeekBucket 2014
 * Author: Alfredo Chi
 *
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

setlocale(LC_ALL,"es_ES@euro","es_ES","esp");

class place extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
	   $this->load->database('default');
        $this->load->model('place_db');
        if (!$this->session->userdata('username')) {
            redirect('admin');
        }
    }

    /**
     * Despliega la pantalla de eventos
     */
    
	public function index($offset = 0){          
        $data['page'] = 'place';     
        $data['place'] = $this->sortSliceArray($this->place_db->getAllActive(),10);//se obtiene los primero 10
		$data['total'] = $this->totalArray($this->place_db->getAllActive());
        
        $this->load->view('admin/vwPlace',$data);   
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
    
    public function getId(){
        if($this->input->is_ajax_request()){
            $data = $this->place_db->getId($_POST['id']);
            echo json_encode($data);
        }
    }
	
	public function getBannerId(){
        if($this->input->is_ajax_request()){
            $data = $this->place_db->getBannerId($_POST['id']);
            echo json_encode($data);
        }
    }
	
	public function paginadorArray(){
		if($this->input->is_ajax_request()){
            $data = $this->place_db->getallSearch($_POST['dato'],$_POST['column'],$_POST['order']);
			$array = array_slice($data, $_POST['cantidad'], 10);
            echo json_encode($array);
        }
	}
	
	public function getallSearch(){
		if($this->input->is_ajax_request()){
            $data = $this->place_db->getallSearch($_POST['dato'],$_POST['column'],$_POST['order']);
            echo json_encode($data);
        }
	}
	
	public function getAllGalleryById(){
		if($this->input->is_ajax_request()){
            $data = $this->place_db->getAllGalleryById($_POST['placeId']);
            echo json_encode($data);
        }
	}
	
	public function saveEvent(){
		if($this->input->is_ajax_request()){
			if($_POST['id'] == 0){
				
				$nameImage = json_decode(stripslashes($_POST['image']));
				
				$insert = array(
   					'name' 			=> $_POST['name'],
   					'cityId' 		=> $_POST['cityId'],
   					'image' 		=> $nameImage[0],
					'title' 		=> $_POST['title'],
					'txtMin' 		=> $_POST['txtMin'],
					'txtMax' 		=> $_POST['txtMan'],
					'weatherKey' 	=> $_POST['weatherKey'],
					'latitude' 		=> $_POST['latitude'],
					'longitude' 	=> $_POST['longitude'],
					'status' 		=> 1
				);
				
				$data = $this->place_db->insertPlace($insert,$nameImage);
				$data = "Se han agregado un nuevo lugar";
				
			} else {
				
				$update = array(
					'id'			=> $_POST['id'],
					'name' 			=> $_POST['name'],
   					'cityId' 		=> $_POST['cityId'],
					'title' 		=> $_POST['title'],
					'txtMin' 		=> $_POST['txtMin'],
					'txtMax' 		=> $_POST['txtMan'],
					'weatherKey' 	=> $_POST['weatherKey'],
					'latitude' 		=> $_POST['latitude'],
					'longitude' 	=> $_POST['longitude']
				);
				$data = $this->place_db->updatePlace($update);
				$data = "Se han editado los datos del lugar";
			}
            
            echo json_encode($data);
        }
	}
	
	public function deletePlace(){
		if($this->input->is_ajax_request()){
				$delete = array(
					'id' => $_POST['id'],
   					'status' => 0
				);
				$data = $this->place_db->updatePlace($delete);
				$data = "Se ha eliminado el lugar";
            	echo json_encode($data);
        }
	}
	
	public function saveGallery(){
		if($this->input->is_ajax_request()){
			if($_POST['add'] == 1){
				
				$insert = array();
				
				foreach(json_decode(stripslashes($_POST['image'])) as $image){
					array_push($insert, array(
						'placeId' 	=> $_POST['placeId'],
   						'image' 	=> $image,
						'status' 	=> 1
					));
				}
				$data = $this->place_db->insertGallery($insert);
				$data = "Se han actualizado la galeria";
				
			} 
			if($_POST['save'] == 1){
				$update = array();
					
				foreach(json_decode(stripslashes($_POST['idImage'])) as $id){
					array_push($update, array(
						'id' 		=> $id,
   						'status' 	=> 0
					));
				}
					
				$data = $this->place_db->updateGallery($update);
				$data = "Se han actualizado la galeria";
			}
            
            echo json_encode($data);
        }
	}
	
	public function uploadImage(){
		
  		$ruta = explode(",",$_POST['ruta']);
		$nameImage = explode(",",$_POST['imageName']);
		
		$con = 0;		
  		foreach ($_FILES as $key) {
    		if($key['error'] == UPLOAD_ERR_OK ){//Verificamos si se subio correctamente
      			$nombre = $key['name'];//Obtenemos el nombre del archivo
      			$temporal = $key['tmp_name']; //Obtenemos el nombre del archivo temporal
      			$tamano= ($key['size'] / 1000)."Kb"; //Obtenemos el tamaño en KB
				$tipo = $key['type']; //obtenemos el tipo de imagen
				
				if($nameImage[$con] != "0"){
					$nombreTimeStamp = $nameImage[$con];
				} else {
					$fecha = new DateTime();
        			$nombreTimeStamp = "adondeIr_" . $fecha->getTimestamp() . $con . ".jpg";
				}
				
				move_uploaded_file($temporal, $ruta[$con] . $nombreTimeStamp);
				
				$con++;
				
    		}else{
    		}
			echo $nombreTimeStamp . "*-*";
		}
	}
	
	public function uploadImageGallery(){
		
		$total = $_POST['total'];
		
		for($i = 0;$i<$total;$i++){
			
			$fecha = new DateTime();
        	$nombreTimeStamp = "gallery_" . $fecha->getTimestamp() . $i . ".jpg";
			$nombreTimeStampThumb = "thumb_" . $nombreTimeStamp;
			
			$gallery = "gallery" . $i;
			$thumb = "thumb" . $i;
			
			$rutaGallery = "assets/img/app/visita/galeria/";
			$rutaThunb = "assets/img/app/visita/galeria/";
			
      		$temporal = $_FILES[$gallery]['tmp_name'];
			
			move_uploaded_file($temporal, $rutaGallery . $nombreTimeStamp);
			
			$temporal = $_FILES[$thumb]['tmp_name'];
			
			move_uploaded_file($temporal, $rutaThunb . $nombreTimeStampThumb);	
			
			echo $nombreTimeStamp . "*_*";
		}
		
	}
    
}	
