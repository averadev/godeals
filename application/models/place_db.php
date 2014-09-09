<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class place_db extends CI_MODEL
{
 
    public function __construct(){
        parent::__construct();
    }
 
    /**
     * Obtiene todos los registros activos del catalogo
     */
    public function get($id){
        $this->db->select('id, title, txtMax');
        $this->db->from('place');
        $this->db->where('status = 1');
        $this->db->where('id', $id);
        return  $this->db->get()->result();
    }
 
    /**
     * Obtiene todos los registros activos del catalogo
     */
    public function getAll(){
        $this->db->select('id, name, title, txtMin, weatherKey');
        $this->db->from('place');
        $this->db->where('status = 1');
        $this->db->order_by("id", "asc");
        return  $this->db->get()->result();
    }
    
    /**
     * Obtiene todos los registros activos del catalogo
     */
    public function getByType($type){
        $this->db->select('place.id, place.name, place.title, place.txtMin, place.weatherKey');
        $this->db->from('xref_place_type');
        $this->db->join('place', 'xref_place_type.placeId = place.id');
        $this->db->where('place.status = 1');
        $this->db->where('xref_place_type.placeTypeId', $type);
        $this->db->order_by("place.id", "asc");
        return  $this->db->get()->result();
    }
    
    /**
     * Obtiene todos los registros activos del catalogo
     */
    public function getBanners($id){
        $this->db->select('image');
        $this->db->from('place_banner');
        $this->db->where('status = 1');
        $this->db->where('placeId', $id);
        return  $this->db->get()->result();
    }
    
    /**
     * Obtiene todos los registros activos del catalogo
     */
    public function getBars($id){
        $this->db->select('nombre, info, address, phone');
        $this->db->from('place_bar');
        $this->db->where('status = 1');
        $this->db->where('placeId', $id);
        return  $this->db->get()->result();
    }
    
    /**
     * Obtiene todos los registros activos del catalogo
     */
    public function getHotels($id){
        $this->db->select('nombre, info, address, phone');
        $this->db->from('place_hotel');
        $this->db->where('status = 1');
        $this->db->where('placeId', $id);
        return  $this->db->get()->result();
    }
    
    /**
     * Obtiene todos los registros activos del catalogo
     */
    public function getRestaurants($id){
        $this->db->select('nombre, info, address, phone');
        $this->db->from('place_restaurant');
        $this->db->where('status = 1');
        $this->db->where('placeId', $id);
        return  $this->db->get()->result();
    }
    
    /**
     * Obtiene todos los registros activos del catalogo
     */
    public function getPhotos($id){
        $this->db->select('image');
        $this->db->from('place_photo');
        $this->db->where('status = 1');
        $this->db->where('placeId', $id);
        return  $this->db->get()->result();
    }
    
    /**
     * Obtiene todos los registros activos del catalogo
     */
    public function getTransport($id){
        $this->db->select('transport.id, transport.name');
        $this->db->from('xref_place_transport');
        $this->db->join('transport', 'transport.id = xref_place_transport.transportId');
        $this->db->where('transport.status = 1');
        $this->db->where('xref_place_transport.placeId', $id);
        return  $this->db->get()->result();
    }
    
    /**
     * Obtiene todos los registros activos del catalogo
     */
    public function getPlaceType($type){
        $this->db->select('id, name');
        $this->db->from('placeType');
        $this->db->where('status = 1');
        $this->db->where('type', $type);
        return  $this->db->get()->result();
    }
    
    


}
//end model