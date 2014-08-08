<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class event_db extends CI_MODEL
{
 
    public function __construct(){
        parent::__construct();
    }
 
    /**
     * Obtiene el registro del catalogo
     */
    public function getEventCategories($id){
        $this->db->select ('categorie.name, xref_event_categorie.eventId, xref_event_categorie.categorieId, xref_event_categorie.contenido');
        $this->db->from('xref_event_categorie');
        $this->db->join('event', 'xref_event_categorie.eventId = event.id ');
        $this->db->join('categorie', 'xref_event_categorie.categorieId = categorie.id ');
        $this->db->where('xref_event_categorie.eventId = ', $id);
        return  $this->db->get()->result();
    }
 
    /**
     * Obtiene todos los registros activos del catalogo
     */
    public function getFav(){
        $this->db->select('event.id, event.word, event.name, event.place, city.name as city, event.date, event.imgMin, event.imgMed, event.imgMax');
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
        $this->db->select('event.id, event.name, event.place, city.name as city, event.imgMin, event.imgMax, event.date, event.fav');
        $this->db->from('event');
        $this->db->join('city', 'event.idCity = city.id ');
        $this->db->where('event.status = 1');
        $this->db->where('event.date >= curdate()');
        $this->db->order_by("event.date", "asc");
        return  $this->db->get()->result();
    }


}
//end model