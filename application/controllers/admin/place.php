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
	
	public function saveEvent(){
		if($this->input->is_ajax_request()){
			if($_POST['id'] == 0){
				$insert = array(
   					'name' 			=> $_POST['name'],
   					'cityId' 		=> $_POST['cityId'],
   					'image' 		=> $_POST['image'],
					'title' 		=> $_POST['title'],
					'txtMin' 		=> $_POST['txtMin'],
					'txtMax' 		=> $_POST['txtMan'],
					'weatherKey' 	=> $_POST['weatherKey'],
					'latitude' 		=> $_POST['latitude'],
					'longitude' 	=> $_POST['longitude'],
					'status' 		=> 1
				);
				$data = $this->place_db->insertPlace($insert);
				$data = "Se han agregado un nuevo lugar";
				
			} else {
				$update = array(
					'id'			=> $_POST['id'],
					'name' 			=> $_POST['name'],
   					'cityId' 		=> $_POST['cityId'],
   					'image' 		=> $_POST['image'],
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
	
	public function uploadImage(){
		
  		foreach ($_FILES as $key) {
    		if($key['error'] == UPLOAD_ERR_OK ){//Verificamos si se subio correctamente
      			$nombre = $key['name'];//Obtenemos el nombre del archivo
      			$temporal = $key['tmp_name']; //Obtenemos la dirrecion del archivo
      			$tamano= ($key['size'] / 1000)."Kb"; //Obtenemos el tamaño en KB
				$tipo = $key['type']; //obtenemos el tipo de imagen
				
				$ruta="assets/img/app/visita/";
				$max_ancho = 700;
				$max_alto = 525;
				
				list($ancho,$alto)=getimagesize($temporal);
				//Creamos una imagen en blanco con el ancho y alto final
				$tmp=imagecreatetruecolor($max_ancho,$max_alto);
				
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
					$patch_imagen=$ruta . "adondeir_" . $nombreTimeStamp .".jpg";
				
				//Copiamos la imagen sobre la imagen que acabamos de crear en blanco
					imagecopyresampled($tmp,$imagen,0,0,0,0,$max_ancho, $max_alto,$ancho,$alto);
					imagejpeg($tmp,$patch_imagen,100);
					//Se destruye variable $img_original para liberar memoria
					imagedestroy($imagen);
      			
				//echo json_encode($_FILES);
				
					echo "adondeir_" . $nombreTimeStamp . ".jpg";
				
    		}else{
				
    		}
		}
	}
    
}	
