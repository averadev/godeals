<?php
/**
 * GeekBucket 2014
 * Author: Alfredo Chi
 *
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

setlocale(LC_ALL,"es_ES@euro","es_ES","esp");

class asignarComercio extends CI_Controller {
	

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
        $data['comercio'] = $this->sortSliceArray($this->place_db->getXrefActive($_GET['id']),10);//se obtiene los primero 10
		$data['total'] = $this->totalArray($this->place_db->getXrefActive($_GET['id']));
		$data['idPlace'] = $_GET['id'];
        
        $this->load->view('admin/vwAsignarComercio',$data);
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
	
	public function getXrefByIds(){
        if($this->input->is_ajax_request()){
            $data = $this->place_db->getXrefByIds($_POST['placeId'],$_POST['partnerId']);
            echo json_encode($data);
        }
    }
	
	public function paginadorArray(){
		if($this->input->is_ajax_request()){
            $data = $this->place_db->getallSearchXref($_POST['idPlace'],$_POST['dato']);
			$array = array_slice($data, $_POST['cantidad'], 10);
            echo json_encode($array);
        }
	}
	
	public function getallSearch(){
		if($this->input->is_ajax_request()){
            $data = $this->place_db->getallSearchXref($_POST['idPlace'],$_POST['dato']);
            echo json_encode($data);
        }
	}
	
	public function saveEvent(){
		if($this->input->is_ajax_request()){
			if($_POST['typeQuery'] == 0){
				$insert = array(
   					'placeId' 		=> $_POST['idPlace'],
   					'partnerId' 	=> $_POST['idPartner'],
   					'type' 			=> $_POST['type']
				);
				$data = $this->place_db->insertXref($insert);
				$data = "Se han agregado un comercio";
			} /*else {
				$update = array(
					'placeId' 		=> $_POST['idPlace'],
   					'partnerId' 	=> $_POST['idPartner'],
   					'type' 			=> $_POST['type']
				);
				$data = $this->place_db->updateXref($update,$_POST['idPartner2']);
				$data = "Se han editado los datos del comercio";
			}*/
            
            echo json_encode($data);
        }
	}
	
	public function deleteXref(){
		if($this->input->is_ajax_request()){
			$delete = array(
				'placeId' 		=> $_POST['idPlace'],
   				'partnerId' 	=> $_POST['idPartner']
			);
			$data = $this->place_db->deleteXref($delete);
			$data = "Se ha eliminado el comercio";
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
