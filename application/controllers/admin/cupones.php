<?php
/**
 * GeekBucket 2014
 * Author: Alfredo Chi
 *
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

setlocale(LC_ALL,"es_ES@euro","es_ES","esp");

class Cupones extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
		$this->load->database('default');
        $this->load->model('coupon_db');
        $this->load->model('catalogo_db');
        if (!$this->session->userdata('username')) {
            redirect('admin');
        }
    }

    /**
     * Despliega la pantalla de eventos
     */
    
	public function index($offset = 0){        
        $data['page'] = 'cupones';
        $data['coupon'] = $this->sortSliceArray($this->coupon_db->getAllActive(),10);//se obtiene los primero 10
		$data['total'] = $this->totalArray($this->coupon_db->getAllActive());//numeor todal de cupones
		$data['entretenimiento'] = $this->catalogo_db->getCatalog(2);//catalogo de tipo entretenimiento
        $data['servicio'] = $this->catalogo_db->getCatalog(1);//catalogo de tipo servicio o producto
		
        $this->load->view('admin/vwCupones',$data);   
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
	
	public function paginadorArray(){
		if($this->input->is_ajax_request()){
            $data = $this->coupon_db->getallSearch($_POST['dato'],$_POST['column'],$_POST['order']);
			$array = array_slice($data, $_POST['cantidad'], 10);
            echo json_encode($array);
        }
	}
	
	public function getallSearch(){
		if($this->input->is_ajax_request()){
            $data = $this->coupon_db->getallSearch($_POST['dato'],$_POST['column'],$_POST['order']);
            echo json_encode($data);
        }
	}
	
	public function getID(){
		if($this->input->is_ajax_request()){
            $data = $this->coupon_db->getId($_POST['id']);
            echo json_encode($data);
        }
	}
	
	public function getCatalogOfCoupon(){
		if($this->input->is_ajax_request()){
            $data = $this->catalogo_db->getCatalogOfCoupon($_POST['couponId']);
            echo json_encode($data);
        }
	}
	
	public function saveCoupon(){
		if($this->input->is_ajax_request()){
			
			if($_POST['id'] == 0){
				
				$insert = array(
				'partnerId' => $_POST['partnerId'],
				'cityId' => $_POST['cityId'],
				'timer' => $_POST['timer'],
				'image' => $_POST['image'],
				'description' => $_POST['description'],
				'validity' => $_POST['validity'],
				'clauses' => $_POST['clauses'],
				'detail' => $_POST['detail'],
				'iniDate' => $_POST['iniDate'],
				'endDate' => $_POST['endDate'],
				'status' => 1);
				
				$data = $this->coupon_db->insertCoupon($insert,json_decode(stripslashes($_POST['idCatalog'])));
				$data = "Se ha agregado un nuevo Cupon";
			} else {
				
				$update = array(
				'id' => $_POST['id'],
				'partnerId' => $_POST['partnerId'],
				'cityId' => $_POST['cityId'],
				'timer' => $_POST['timer'],
				'image' => $_POST['image'],
				'description' => $_POST['description'],
				'validity' => $_POST['validity'],
				'clauses' => $_POST['clauses'],
				'detail' => $_POST['detail'],
				'iniDate' => $_POST['iniDate'],
				'endDate' => $_POST['endDate']);
				
				$delete = array('couponId' => $_POST['id']);
				
				$catalog = array();
				$idCatalog = json_decode(stripslashes($_POST['idCatalog']));
				foreach($idCatalog as $idC){
					array_push($catalog, array(
						'couponId' => $_POST['id'],
						'catalogId'=> $idC));
				}
				
				$data = $this->coupon_db->updateCoupon($update,$delete,$catalog);
				$data = "Se ha editado los datos del coupon";
			}
            echo json_encode($data);
        }
	}
	
	public function deleteCoupon(){
		if($this->input->is_ajax_request()){
			
			$delete = array(
				'id' => $_POST['id'],
				'status' => 0
			);
			
            $data = $this->coupon_db->deleteCoupon($delete);
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
		if($this->input->is_ajax_request()){
			//$rutaMax="assets/img/app/coupon/max/";
			//$rutaMin="assets/img/app/coupon/min/";
			//unlink($rutaMax . $_POST['deleteImage']);
			//unlink($rutaMin . $_POST['deleteImage']);
		}
	}
	
}