<?php
/**
 * GeekBucket 2014
 * Author: Polanco Alan
 *
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

setlocale(LC_ALL,"es_ES@euro","es_ES","esp");

class Partners extends CI_Controller {
 
    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->database('default');
        $this->load->model('partner_db');
        $this->load->model('map_category_db');
        if (!$this->session->userdata('username')) {
            redirect('admin');
        }
    }
    
	public function index($offset = 0){           
        $data['page'] = 'partners';  
        $data['partner'] = $this->sortSliceArray($this->partner_db->getAllActive(),10);
        $data['total'] = $this->totalArray($this->partner_db->getAllActive());//numero total de partners
	
        $data['map_category'] = $this->map_category_db->getAllMapCat();
        $this->load->view('admin/vwPartners',$data);
            
        }
    
    public function totalArray($array){
        $array = count($array);
        return $array;
    }
	
	/**
	*	regresa 10 partner 
	*/
    public function paginadorArray(){
        if($this->input->is_ajax_request()){
            $data = $this->partner_db->getAllSearch($_POST['dato'],$_POST['column'],$_POST['order']);
            $array = array_slice($data, $_POST['cantidad'], 10);
            echo json_encode($array);
        }
    }
    
	/**
	* regresa todos los partner 
	*/
    public function getAllSearch(){   
        if($this->input->is_ajax_request()){
            $data = $this->partner_db->getAllSearch($_POST['dato'],$_POST['column'],$_POST['order']);
            echo json_encode($data);
        }
    }
    
    public function sortSliceArray($array, $count){
        if (count($array) > $count){
            $array = array_slice($array, 0, $count);
        }
        return $array;
    }
    
	/**
	* obtiene partner por id
	*/
    public function getId(){
        if($this->input->is_ajax_request()){
            $data = $this->partner_db->getId($_POST['id']);
            echo json_encode($data);
        }    
    }
	
	/**
	*	regresa los partner por nombre
	*/
	public function getPartner(){
        if($this->input->is_ajax_request()){
            $data = $this->partner_db->getNameSearch($_POST['dato']);
            echo json_encode($data);
        }
    }
	
	/**
	*	valida que el amail no exista en la base de datos
	*/
	public function getEmail(){
		if($this->input->is_ajax_request()){
            $data = $this->partner_db->getEmail($_POST['email']);
            echo json_encode($data);
        }
	}
	
	/**
	* inserta o actualiza los datos del partner
	*/
    public function savePartner(){
         if($this->input->is_ajax_request()){
             if($_POST['id']==0){
                $data = $this->partner_db->insertPartner(array(
                    'name'      => $_POST['name'],
                    'logo'      => $_POST['logo'],
                    'idCatMap'  => $_POST['idCatMap'],
                    'address'   => $_POST['address'],
                    'phone'     => $_POST['phone'],
                    'mail'      => $_POST['mail'],
                    'twitter'   => $_POST['twitter'],
                    'facebook'  => $_POST['facebook'],
                    'latitude'  => $_POST['latitude'],
                    'longitude' => $_POST['longitude'],
					'info' 		=> $_POST['info'],
                    'status'    => 1
                    )
                ); 
				$data = "Se han agregado un nuevo partner";
               // echo json_encode($data);
            }
            else {
                $data = $this->partner_db->updatePartner(array(
                    'id'        => $_POST['id'],
                    'name'      => $_POST['name'],
                    'logo'      => $_POST['logo'],
                    'idCatMap'  => $_POST['idCatMap'],
                    'address'   => $_POST['address'],
                    'phone'     => $_POST['phone'],
                    'mail'      => $_POST['mail'],
                    'twitter'   => $_POST['twitter'],
                    'facebook'  => $_POST['facebook'],
                    'latitude'  => $_POST['latitude'],
                    'longitude' => $_POST['longitude'],
					'info'		=> $_POST['info'],
                    'status'    => 1
                    )
                );
				$data = "Se han editado los datos del partner";
            }
            echo json_encode($data);
        }
    }
    
	/**
	* actualiza el status a 0
	*/
    public function deletePartner(){
        if($this->input->is_ajax_request()){
            $data = $this->partner_db->deletePartner($_POST['id']);
            echo json_encode($data);
        }
    }
    
    
    /*------------------Imagen*-----------------*/
      
     
    public function uploadImage(){

        $ruta = "assets/img/app/logo/";
        
        foreach ($_FILES as $key) {
            if($key['error'] == UPLOAD_ERR_OK ){//Verificamos si se subio correctamente
                $nombre = $key['name'];//Obtenemos el nombre del archivo
                $temporal = $key['tmp_name']; //Obtenemos el nombre del archivo temporal
                $tamano= ($key['size'] / 1000)."Kb"; //Obtenemos el tamaño en KB
                $tipo = $key['type']; //obtenemos el tipo de imagen
                
                //se crea nombre  a partir del timestamp
                $fecha = new DateTime();
                $nombreTimeStamp = "partner_" . $fecha->getTimestamp() .".jpg";
                move_uploaded_file($temporal, $ruta . $nombreTimeStamp);
                
                echo $nombreTimeStamp;

            }
        }	
    }
     
    public function deleteImage(){
        if($this->input->is_ajax_request()){
            $rutaMax="assets/img/app/logo/";
            unlink($rutaMax . $_POST['deleteImage']);
        }   
    }
  
}
