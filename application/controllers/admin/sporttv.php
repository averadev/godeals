<?php
/**
 * GeekBucket 2014
 * Author: Chi Alfredo
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
        if (!$this->session->userdata('username')) {
            redirect('admin');
        }
    }

    /**
     * Despliega la pantalla de eventos
     */
    public function index(){
        // Get available dates        
        $data['page'] = 'sporttv';  
       $data['sporttv'] = $this->sortSliceArray($this->sporttv_db->getAllSporttv(),10);//se obtiene los primero 10
	   $data['total'] = $this->totalArray($this->sporttv_db->getAllSporttv());
	   $data['type'] = $this->sporttv_db->getAllSporttvType();
        
        // Get View
        $this->load->view('admin/vwSporttv',$data);
    }
	
	public function sortSliceArray($array, $count){
		if (count($array) > $count){
            $array = array_slice($array, 0, $count);
        }
        return $array;
	}
	
	public function totalArray($array){
        $array = count($array);
        return $array;
    }
	
	public function getAllSporttvType(){
		if($this->input->is_ajax_request()){
            $data = $this->sporttv_db->getAllSporttvType();
            echo json_encode($data);
        }	
	}
	
	public function paginadorArray(){
		if($this->input->is_ajax_request()){
            $data = $this->sporttv_db->getallSearch($_POST['dato'],$_POST['column'],$_POST['order']);
			$array = array_slice($data, $_POST['cantidad'], 10);
            echo json_encode($array);
        }
	}
	
	public function getallSearch(){
		if($this->input->is_ajax_request()){
            $data = $this->sporttv_db->getallSearch($_POST['dato'],$_POST['column'],$_POST['order']);
            echo json_encode($data);
        }
	}
	
	public function getSporttvId(){
		if($this->input->is_ajax_request()){
            $data = $this->sporttv_db->getSporttvId($_POST['id']);
            echo json_encode($data);
        }
	}
	
	public function getSporttvBarId(){
		if($this->input->is_ajax_request()){
            $data = $this->sporttv_db->getSporttvBarId($_POST['id']);
            echo json_encode($data);
        }	
	}
	
	public function saveSporttv(){
		if($this->input->is_ajax_request()){
			if($_POST['id'] == 0){
				$insert = array(
   					'name' => $_POST['name'],
   					'torneo' => $_POST['torneo'],
   					'sporttvTypeId' => $_POST['sporttvTypeId'],
					'image' => $_POST['image'],
					'date' => $_POST['date'],
					'status' => 1
				);
				$data = $this->sporttv_db->insertSporttv($insert);
				if($_POST['partnerId'] != '0'){
					$data = $this->saveSporttvBar($data,json_decode(stripslashes($_POST['partnerId']))
					,json_decode(stripslashes($_POST['nameImage'])));	
				}
				$data = "Se han agregado un nuevo sporttv";
			} else {
				$update = array(
					'id' => $_POST['id'],
   					'name' => $_POST['name'],
   					'torneo' => $_POST['torneo'],
   					'sporttvTypeId' => $_POST['sporttvTypeId'],
					'image' => $_POST['image'],
					'date' => $_POST['date']
				);
				$data = $this->sporttv_db->updateSporttv($update);
				
				if($_POST['partnerId'] != '0'){
					$data = $this->saveSporttvBar($_POST['id'],json_decode(stripslashes($_POST['partnerId']))
					,json_decode(stripslashes($_POST['nameImage'])));
				}
				$data = "Se han editado los datos del sporttv";
			}
            echo json_encode($data);
        }
	}
	
	public function saveSporttvBar($id,$partnerId,$nameImage){
			$data2 = $this->sporttv_db->getAllSporttvBarId($id);
			$total = count($partnerId);
			
			$array = array();
			
			for($i=0;$i<$total;$i++){
				$cont = 0;
				
				foreach ($data2 as $row)
				{
					if($row->partnerId == $partnerId[$i]){
						
						$update = array(
						'sporttvId' => $id,
						'partnerId' => $partnerId[$i],
						'image' => $nameImage[$i],
						'status' => 1
						);	
						$data = $this->sporttv_db->updateSporttvBar($update);
						$cont++;
						
					}
				}
				
				if($cont == 0){
					array_push($array, array(
						'sporttvId' => $id,
						'partnerId' => $partnerId[$i],
						'image' => $nameImage[$i],
						'status' => 1
					));
				}
			}
			if(count($array) > 0){
				$data = $this->sporttv_db->insertSporttvBar($array);	
			}
			
			return ($data2);
	}
	
	public function deleteSporttv(){
		if($this->input->is_ajax_request()){
			$delete = array(
					'id' => $_POST['id'],
					'status' => 0
			);
			$data = $this->sporttv_db->deleteSporttv($delete);
			$data = "se ha eliminado el sporttv";
			echo json_encode($data);
		}
	}
	
	public function deleteSporttvBar(){
		
		if($this->input->is_ajax_request()){
		
			$deleteImage = json_decode(stripslashes($_POST['deleteImage']));
			
			$delete = array();
			
			foreach($deleteImage as $image){
					array_push($delete, array(
						'image' => $image,
						'status'=> 0
					));
			}
			
			$data = $this->sporttv_db->deleteSporttvBar($delete);
			echo json_encode($data);
		}
	}
	
	public function uploadImage(){
        $rutaApp="assets/img/app/sporttv/app/";
		$rutaMax="assets/img/app/sporttv/max/";
  		foreach ($_FILES as $key) {
    		if($key['error'] == UPLOAD_ERR_OK ){//Verificamos si se subio correctamente
      			$nombre = $key['name'];//Obtenemos el nombre del archivo
      			$temporal = $key['tmp_name']; //Obtenemos la dirrecion del archivo
      			$tamano= ($key['size'] / 1000)."Kb"; //Obtenemos el tamaño en KB
				$tipo = $key['type']; //obtenemos el tipo de imagen
				
				//definimos el ancho y alto que tendra la imagen
				$app_ancho = 440;
				$app_alto = 330;
                $max_ancho = 700;
				$max_alto = 525;
				list($ancho,$alto)=getimagesize($temporal);
				//Creamos una imagen en blanco con el ancho y alto final
				$tmpApp=imagecreatetruecolor($app_ancho,$app_alto);
                $tmpMax=imagecreatetruecolor($max_ancho,$max_alto);
				
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
                
                $patch_imagenApp=$rutaApp . "sport_" . $nombreTimeStamp .".jpg";
                $patch_imagenMax=$rutaMax . "sport_" . $nombreTimeStamp . ".jpg";
				
				//Copiamos la imagen sobre la imagen que acabamos de crear en blanco
                imagecopyresampled($tmpApp, $imagen,0,0,0,0, $app_ancho, $app_alto, $ancho, $alto);
                imagejpeg($tmpApp, $patch_imagenApp,100);
                
                imagecopyresampled($tmpMax, $imagen,0,0,0,0, $max_ancho, $max_alto, $ancho, $alto);
                imagejpeg($tmpMax, $patch_imagenMax,100);
                
      			
				//echo json_encode($_FILES);
				echo "sport_" . $nombreTimeStamp . ".jpg";
				
    		}else{
				
    		}
		}
	}
	
	public function deleteImage(){
		if($this->input->is_ajax_request()){
            $rutaMax="assets/img/app/event/max/";
			unlink($rutaMax . $_POST['deleteImage']);
        }
	}
	
	public function uploadImageBar(){
		$rutaMax="assets/img/app/sporttv/min/";
		
		$max_ancho = 320;
		$max_alto = 240;
		
		$i = 0;
		
  		foreach ($_FILES as $key) {
    		if($key['error'] == UPLOAD_ERR_OK ){//Verificamos si se subio correctamente
      			$nombre = $key['name'];//Obtenemos el nombre del archivo
      			$temporal = $key['tmp_name']; //Obtenemos la dirrecion del archivo
      			$tamano= ($key['size'] / 1000)."Kb"; //Obtenemos el tamaño en KB
				$tipo = $key['type']; //obtenemos el tipo de imagen
				
				list($ancho,$alto)=getimagesize($temporal);
				
				$tmpMax=imagecreatetruecolor($max_ancho,$max_alto);
				
				if($tipo == "image/png"){
					//toma la ruta de la imagen
					$imagen = imagecreatefrompng($temporal); 
				//detecta si la imagen es tipo gif 	
				} else if($tipo == "image/gif"){
					$imagen = imagecreatefromgif($temporal);	
				} else {
					$imagen = imagecreatefromjpeg($temporal); 
				}
				
				$fecha = new DateTime();
				$nombreTimeStamp = $fecha->getTimestamp();
				
				//toma la ruta de la imagen a crear
				$patch_imagenMax=$rutaMax . "barEvent_" . $nombreTimeStamp . $i .".jpg";
				
				//Copiamos la imagen sobre la imagen que acabamos de crear en blanco
				imagecopyresampled($tmpMax,$imagen,0,0,0,0,$max_ancho, $max_alto,$ancho,$alto);
				imagejpeg($tmpMax,$patch_imagenMax,100);
	
				//Se destruye variable $img_original para liberar memoria
				imagedestroy($imagen);
				
				echo "barEvent_" . $nombreTimeStamp . $i .".jpg*-*";
				
				$i++;
				
    		}else{
				
    		}
		}
	}
}