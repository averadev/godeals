<?php
/**
 * GeekBucket 2014
 * Author: Alfredo Chi
 *
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

setlocale(LC_ALL,"es_ES@euro","es_ES","esp");

class publicity extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
	   $this->load->database('default');
        $this->load->model('publicity_db');
        if (!$this->session->userdata('username')) {
            redirect('admin');
        }
    }

    /**
     * Despliega la pantalla de eventos
     */
    
	public function index($offset = 0){          
        $data['page'] = 'publicidad';     
        $data['publicity'] = $this->sortSliceArray($this->publicity_db->getAllPublicity(),10);//se obtiene los primero 10
		$data['total'] = $this->totalArray($this->publicity_db->getAllPublicity());
        
        $this->load->view('admin/vwPublicidad',$data);   
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
            $data = $this->publicity_db->get($_POST['id']);
            echo json_encode($data);
        }
    }
	
	public function paginadorArray(){
		if($this->input->is_ajax_request()){
            $data = $this->publicity_db->getallSearch($_POST['dato'],$_POST['column'],$_POST['order']);
			$array = array_slice($data, $_POST['cantidad'], 10);
            echo json_encode($array);
        }
	}
	
	public function getallSearch(){
		if($this->input->is_ajax_request()){
            $data = $this->publicity_db->getallSearch($_POST['dato'],$_POST['column'],$_POST['order']);
            echo json_encode($data);
        }
	}
	
	public function saveEvent(){
		if($this->input->is_ajax_request()){
			if($_POST['id'] == 0){
				$insert = array(
   					'partnerId' 	=> $_POST['partnerId'],
   					'image' 		=> $_POST['image'],
   					'iniDate' 		=> $_POST['iniDate'],
					'endDate' 		=> $_POST['endDate'],
					'category' 		=> $_POST['category'],
					'status' 		=> 1
				);
				$data = $this->publicity_db->insertPublicity($insert);
				$data = "Se han agregado una nueva publicidad";
			} else {
				$update = array(
					'id'			=> $_POST['id'],
					'partnerId' 	=> $_POST['partnerId'],
   					'image' 		=> $_POST['image'],
   					'iniDate' 		=> $_POST['iniDate'],
					'endDate' 		=> $_POST['endDate'],
					'category' 		=> $_POST['category']
				);
				$data = $this->publicity_db->updatePublicity($update);
				$data = "Se han editado los datos de la publicidad";
			}
            
            echo json_encode($data);
        }
	}
	
	public function deletePublicity(){
		if($this->input->is_ajax_request()){
				$delete = array(
					'id' => $_POST['id'],
   					'status' => 0
				);
				$data = $this->publicity_db->deletePublicity($delete);
				$data = "Se ha eliminado la publcidad";
            	echo json_encode($data);
        }
	}
	
	public function uploadImage(){
		
		switch($_POST['category']){
			case 1:
				$ruta="assets/img/app/publicity/banner/";
				$max_ancho = 1000;
				$max_alto = 350;
				break;
			case 2:
				$ruta="assets/img/app/publicity/mediobanner/";
				$max_ancho = 450;
				$max_alto = 270;
				break;
			case 3:
				$ruta="assets/img/app/publicity/lateral/";
				$max_ancho = 220;
				$max_alto = 620;
				break;
			case 4:
				$ruta="assets/img/app/publicity/cintillo/";
				$max_ancho = 650;
				$max_alto = 100;
                break;
			case 5:
				$ruta="assets/img/app/publicity/movil/";
				$max_ancho = 444;
				$max_alto = 80;
                break;
		}
		
  		foreach ($_FILES as $key) {
    		if($key['error'] == UPLOAD_ERR_OK ){//Verificamos si se subio correctamente
      			$nombre = $key['name'];//Obtenemos el nombre del archivo
      			$temporal = $key['tmp_name']; //Obtenemos la dirrecion del archivo
      			$tamano= ($key['size'] / 1000)."Kb"; //Obtenemos el tamaño en KB
				$tipo = $key['type']; //obtenemos el tipo de imagen
				
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
                $patch_imagen=$ruta . "publicity_" . $nombreTimeStamp .".jpg";

                //Copiamos la imagen sobre la imagen que acabamos de crear en blanco
                imagecopyresampled($tmp,$imagen,0,0,0,0,$max_ancho, $max_alto,$ancho,$alto);
                imagejpeg($tmp,$patch_imagen,100);
                //Se destruye variable $img_original para liberar memoria
                imagedestroy($imagen);

                echo "publicity_" . $nombreTimeStamp . ".jpg";
				
    		}else{
				
    		}
		}
	}
    
}	
