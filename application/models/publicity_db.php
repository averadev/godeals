<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class publicity_db extends CI_MODEL
{
 
    public function __construct(){
        parent::__construct();
    }
	
	 /**
     * Obtiene el registro de un evento
     */
    public function get($id){
        $this->db->select('publicity.id, publicity.iniDate, publicity.endDate, publicity.category, partner.name as namePartner, publicity.image, publicity.partnerId');
        $this->db->from('publicity');
        $this->db->join('partner', 'publicity.partnerId = partner.id ');
        $this->db->where('publicity.id = ', $id);
        $this->db->where('publicity.status = 1');
        return  $this->db->get()->result();
    }
	
	/**
	*optiene todos las publcidades activas
	*/
	public function getAllPublicity(){
		$this->db->select('publicity.id, publicity.iniDate, publicity.endDate, publicity.category, partner.name as namePartner');
        $this->db->from('publicity');
        $this->db->join('partner', 'publicity.partnerId = partner.id ');
        $this->db->where('publicity.status = 1');
        $this->db->order_by("id", "ASC");
        return  $this->db->get()->result();
	}
	
	/**
	*optiene los eventos de la busqueda
	*/
	public function getallSearch($dato,$column,$order){
		$this->db->select('publicity.id, publicity.iniDate, publicity.endDate, publicity.category, partner.name as namePartner');
        $this->db->from('publicity');
        $this->db->join('partner', 'publicity.partnerId = partner.id ');
		$this->db->where('publicity.status = 1');
		$this->db->where('(partner.name LIKE \'%'.$dato.'%\' OR publicity.category LIKE \'%'.$dato.'%\')', NULL); 
		$this->db->order_by($column , $order);
        return  $this->db->get()->result();
	}
	
	
	/**
	* inserta los datos de un evento
	*/
	public function insertPublicity($data){
		$this->db->insert('publicity', $data);
	}
	
	/**
	* actualiza los datos de un evento
	*/
	public function updatePublicity($data){
		$this->db->where('id', $data['id']);
		$this->db->update('publicity', $data);
	}
	
	/**
	*actualiza el status a 0 de un evento
	*/
	public function deletePublicity($data){
		$this->db->where('id', $data['id']);
		$this->db->update('publicity', $data);
	}
    
    
    
    /**
     * Obtiene todos los registros activos del catalogo
     */
    public function getBanners(){
        $this->db->select('publicity.id, publicity.image, publicity.partnerId, partner.logo');
        $this->db->from('publicity');
        $this->db->join('partner', 'publicity.partnerId = partner.id ');
        $this->db->where('publicity.status = 1');
        $this->db->where('publicity.category', 1);
        $this->db->where('partner.status = 1');
        $this->db->where('publicity.iniDate <= curdate()');
        $this->db->where('publicity.endDate >= curdate()');
        return  $this->db->get()->result();
    }
    
    /**
     * Obtiene todos los registros activos del catalogo
     */
    public function getPublicidad($tipo){
        $this->db->select('id, image');
        $this->db->from('publicity');
        $this->db->where('status = 1');
        $this->db->where('category', $tipo);
        $this->db->where('iniDate <= curdate()');
        $this->db->where('endDate >= curdate()');
        return  $this->db->get()->result();
    }
	
}
//end model