<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class map_category_db extends CI_MODEL
{
    public function __construct(){
        parent::__construct();
    }
    
     public function getAllMapCat(){
        $this->db->select('map_category.id, map_category.name');
        $this->db->from('map_category');
        $this->db->where('map_category.status = 1');
        return  $this->db->get()->result();
    }
    
    
    /**
    * obtiene el id y nombre del map_category, sirve para el autocompletar
    **/
    public function getNameSearch($dato){
        $this->db->select('map_category.id, map_category.name');
        $this->db->from('map_category');
        $this->db->like('map_category.name', $dato);
        $this->db->where('map_category.status = 1');
        return  $this->db->get()->result();
    }
    
}


