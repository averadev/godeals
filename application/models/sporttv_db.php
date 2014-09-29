<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class sporttv_db extends CI_MODEL
{
 
    public function __construct(){
        parent::__construct();
    }
 
    /**
     * Obtiene el registro del catalogo
     */
    public function getDates(){
        $this->db->distinct();
        $this->db->select ('date(sporttv.date) as date');
        $this->db->from('sporttv');
        $this->db->where('sporttv.status = 1');
        $this->db->where('date(sporttv.date) >= curdate()');
        $this->db->order_by("sporttv.date");
        return  $this->db->get()->result();
    }
 
    /**
     * Obtiene el registro del catalogo
     */
    public function getEventDate($date){
        $this->db->select ('sporttv.id, sporttv.name, sporttv.torneo, sporttv_type.icon, date(sporttv.date) as date');
        $this->db->select ("date_format(sporttv.date, '%l:%i%p') as time", false);
        $this->db->from('sporttv');
        $this->db->join('sporttv_type', 'sporttv.sporttvTypeId = sporttv_type.id');
        $this->db->where('sporttv.status = 1');
        $this->db->where('sporttv_type.status = 1');
        $this->db->where('date(sporttv.date)', $date);
        $this->db->order_by("sporttv.date");
        return  $this->db->get()->result();
    }
 
    /**
     * Obtiene el registro del catalogo
     */
    public function getEventBar($id){
        $this->db->select ('partner.name, partner.address, sporttv_bar.image');
        $this->db->from('sporttv_bar');
        $this->db->join('partner', 'sporttv_bar.partnerId = partner.id');
        $this->db->where('sporttv_bar.sporttvId', $id);
        $this->db->where('sporttv_bar.status = 1');
        return  $this->db->get()->result();
    }
	
	//Chi Alfredo
	
	/**
	*obtiene los registros de la busqueda
	*/
	
	public function getallSearch($dato,$column,$order){
		$this->db->select('sporttv.id, sporttv.name, sporttv.torneo, sporttv_type.name as nameType, sporttv.image, sporttv.date');
		$this->db->from('sporttv');
        $this->db->join('sporttv_type', 'sporttv.sporttvTypeId = sporttv_type.id');
		$this->db->where('sporttv.status = 1');
		$this->db->where('(sporttv.name LIKE \'%'.$dato.'%\' OR sporttv.torneo LIKE \'%'.$dato.'%\' 
		OR sporttv_type.name LIKE \'%' . $dato . '%\')', NULL); 
		$this->db->order_by($column , $order);
        return  $this->db->get()->result();
	}
	
	/**
	* obtienes todos los sporttv acivos
	*/
	public function getAllSporttv(){
		$this->db->select('sporttv.id, sporttv.name, sporttv.torneo, sporttv_type.name as nameType, sporttv.image, sporttv.date');
		$this->db->from('sporttv');
        $this->db->join('sporttv_type', 'sporttv.sporttvTypeId = sporttv_type.id');
        $this->db->where('sporttv.status = 1');
		$this->db->order_by('id','ASC');
        return  $this->db->get()->result();
	}
	
	/**
	*obtiene un sporttv por la id
	*/
	public function getSporttvId($id){
		$this->db->select('sporttv.id, sporttv.name, sporttv.torneo, sporttv.sporttvTypeId as  typeId, sporttv_type.name as nameType, sporttv.image, sporttv.date');
        $this->db->from('sporttv');
        $this->db->join('sporttv_type', 'sporttv.sporttvTypeId = sporttv_type.id');
        $this->db->where('sporttv.status = 1');
        $this->db->where('sporttv.id = ', $id);
        return  $this->db->get()->result();
	}
	
	/**
	*obtiene todo los sporttv bar por id
	*/
	public function getSporttvBarId($id){
		$this->db->select('sporttv_bar.sporttvId, sporttv_bar.partnerId, sporttv_bar.image, partner.name as namePartner');
        $this->db->from('sporttv_bar');
		$this->db->join('partner', 'sporttv_bar.partnerId = partner.id');
        $this->db->where('sporttv_bar.status = 1');
        $this->db->where('sporttv_bar.sporttvId = ', $id);
        return  $this->db->get()->result();
	}

	/**
	*obtiene todos los tipos de sporttv activos
	*/
	public function getAllSporttvType(){
		$this->db->select('sporttv_type.id, sporttv_type.name');
		$this->db->from('sporttv_type');
		$this->db->where('sporttv_type.status = 1');
		return $this->db->get()->result();
	}
	
	/**
	*obtiene todos los sporttv_bar por id
	*/
	public function getAllSporttvBarId($id){
		$this->db->select('sporttv_bar.partnerId');
		$this->db->from('sporttv_bar');
        $this->db->where('sporttv_bar.sporttvId = ', $id);
		return $this->db->get()->result();
	}
	
	/**
	*inserta los datos de sporttv
	*/
	public function insertSporttv($data){
		$this->db->insert('sporttv', $data);
		return $this->db->insert_id();
	}
	
	/**
	*actualiza los datos de sporttv
	*/
	public function updateSporttv($data){
		$this->db->where('id', $data['id']);
		$this->db->update('sporttv', $data);
	}
	
	/**
	*actualiza el status a 0 //elimina
	*/
	public function deleteSporttv($data){
		$this->db->where('id', $data['id']);
		$this->db->update('sporttv', $data);
	}
	
	public function insertSporttvBar($data){
		$this->db->insert_batch('sporttv_bar', $data);
	}
	
	public function updateSporttvBar($data){
		$this->db->where('sporttvId', $data['sporttvId']);
		$this->db->where('partnerId', $data['partnerId']);
		$this->db->update('sporttv_bar', $data);	
	}
	
	public function deleteSporttvBar($data){
		$this->db->update_batch('sporttv_bar', $data, 'image'); 	
	}
	
}
//end model