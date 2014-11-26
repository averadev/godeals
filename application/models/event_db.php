<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class event_db extends CI_MODEL
{
 
    public function __construct(){
        parent::__construct();
    }
	
	 /**
     * Obtiene el registro de un evento
     */
    public function get($id){
        $this->db->select ('event.id, event.name, event.eventTypeId, event.word, event.info, event.place, event.idCity,'
                . 'event.date, event.endDate, event.image, event.latitude, event.longitude, event.tags, event.fav');
        $this->db->select('city.name as cityName');
		$this->db->select('event_type.name as typeName');
        $this->db->from('event');
        $this->db->join('city', 'event.idCity = city.id ');
		$this->db->join('event_type', 'event.eventTypeId = event_type.id ');
        $this->db->where('event.id = ', $id);
        $this->db->where('event.status = 1');
        return  $this->db->get()->result();
    }
 
    /**
     * Obtiene el registro del catalogo
     */
    public function getEventCategories($id){
        $this->db->select ('event_type.name, xref_event_categorie.eventId, xref_event_categorie.categorieId, xref_event_categorie.contenido');
        $this->db->from('xref_event_categorie');
        $this->db->join('event', 'xref_event_categorie.eventId = event.id ');
        $this->db->join('event_type', 'xref_event_categorie.categorieId = event_type.id ');
        $this->db->where('xref_event_categorie.eventId = ', $id);
        return  $this->db->get()->result();
    }
 
    /**
     * Obtiene el registro del catalogo
     */
    public function getAllCategories($name){
        $this->db->select ('id, name');
        $this->db->from('event_type');
        $this->db->like('name', $name);
        return  $this->db->get()->result();
    }
 
    /**
     * Obtiene todos los registros activos del catalogo
     */
    public function getFav(){
        $this->db->select('event.id, event.word, event.name, event.place, city.name as city, event.date, event.image');
        $this->db->from('event');
        $this->db->join('city', 'event.idCity = city.id ');
        $this->db->where('event.fav = 1');
        $this->db->where('event.status = 1');
        $this->db->where('event.date >= curdate()');
        $this->db->order_by("event.date", "asc");
        return  $this->db->get()->result();
    }
 
    /**
     * Obtiene todos los registros activos del catalogo
     */
    public function getAvailable(){
        $this->db->select('event.id, event.name, event.place, city.name as city, event.image, event.date, event.fav');
        $this->db->from('event');
        $this->db->join('city', 'event.idCity = city.id ');
        $this->db->where('event.status = 1');
        $this->db->where('event.date >= curdate()');
        $this->db->order_by("event.date", "asc");
        return  $this->db->get()->result();
    }
	
	//alfredo chi
	
	/**
	*optiene todos los eventos activos
	*/
	public function getAllEvents(){
		$this->db->select('event.id, event.name, event.place, city.name as city, event.image, event.date, event.fav');
        $this->db->from('event');
        $this->db->join('city', 'event.idCity = city.id ');
        $this->db->where('event.date >= curdate()');
        $this->db->where('event.status = 1');
        $this->db->order_by("id", "ASC");
        return  $this->db->get()->result();
	}
	
	/**
	*optiene los eventos de la busqueda
	*/
	public function getallSearch($dato,$column,$order){
		$this->db->select('event.id, event.name, event.place, city.name as city, event.date,event.fav');
        $this->db->from('event');
        $this->db->join('city', 'event.idCity = city.id ');
        $this->db->where('event.date >= curdate()');
		$this->db->where('event.status = 1');
		$this->db->where('(event.name LIKE \'%'.$dato.'%\' OR event.place LIKE \'%'.$dato.'%\' 
		OR city.name LIKE \'%' . $dato . '%\')', NULL); 
		$this->db->order_by($column , $order);
        return  $this->db->get()->result();
	}
	
	
	/**
	* inserta los datos de un evento
	*/
	public function insertEvent($data){
		$this->db->insert('event', $data);
	}
	
	/**
	* actualiza los datos de un evento
	*/
	public function updateEvent($data){
		$this->db->where('id', $data['id']);
		$this->db->update('event', $data);
	}
	
	/**
	*actualiza el status a 0 de un evento
	*/
	public function deleteEvent($data){
		$this->db->where('id', $data['id']);
		$this->db->update('event', $data);
	}
	
}
//end model