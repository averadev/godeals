<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class partner_db extends CI_MODEL
{
 
    public function __construct(){
        parent::__construct();
    }

    
    /**
     * Obtiene el registro de un partner
     */
    public function getId($id){
        $this->db->select ('partner.id, partner.name, partner.logo, partner.idCatMap, partner.address, partner.phone, partner.mail, partner.twitter, partner.facebook, partner.latitude, partner.longitude, partner.info');
        $this->db->select('map_category.name as categoryName');
        $this->db->from('partner');
        $this->db->join('map_category', 'partner.idCatMap = map_category.id');
        $this->db->where('partner.id = ', $id);
        $this->db->where('partner.status = 1');
        return  $this->db->get()->result();
    }
    
    
        /**
	* obtiene la descripcion, clientes y ubicacion de la busqueda relacionada
	**/
	public function getNameSearch($dato){
            $this->db->select('partner.id, partner.name');
            $this->db->from('partner');
            $this->db->like('partner.name', $dato);
            $this->db->where('partner.status = 1');
            return  $this->db->get()->result();
	}
        
	public function getAllActive(){
            //id,name,logo
		$this->db->select ('partner.id, partner.name, partner.logo, partner.idCatMap, partner.address, partner.phone');
        $this->db->select('map_category.name as categoryName');
		$this->db->from('partner');
		$this->db->join('map_category','partner.idCatMap = map_category.id');
		$this->db->where('partner.status = 1');
		$this->db->order_by("id", "asc");
        return  $this->db->get()->result();
	}
        
        //para mostrar en la tabla paginadora
	public function getAllSearch($dato,$column,$order){
		$this->db->select ('partner.id, partner.name, partner.idCatMap, partner.phone');
		$this->db->select ('map_category.name as categoryName');
        $this->db->from('partner');
        $this->db->join('map_category','partner.idCatMap = map_category.id');
        $this->db->where('partner.status = 1');
        $this->db->where('(partner.name LIKE \'%'.$dato.'%\' OR map_category.name LIKE \'%' . $dato . '%\')', NULL); 
        $this->db->order_by($column , $order);
        return  $this->db->get()->result();
	}
	
	public function insertPartner($data){
		$this->db->insert('partner', $data);
	}
        
    /**
	* actualiza los datos de partner
	*/
	public function updatePartner($data){
		$this->db->where('id', $data['id']);
        $this->db->update('partner', $data);
	}
        
	/*
	*	actualiza el status a 0
	*/
    public function deletePartner($id){
        $data = array(
			'status' => 0
		);
		$this->db->where('id', $id);
		$this->db->update('partner', $data);
    }
	
	public function getEmail($dato){
		$this->db->select('partner.mail');
        $this->db->from('partner');
		$this->db->where('partner.mail = ', $dato);
		return  $this->db->get()->result();
	}
}
//end model

