<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class city_db extends CI_MODEL
{
 
    public function __construct(){
        parent::__construct();
    }
    
    
    
    /**
	* obtiene la descripcion, clientes y ubicacion de la busqueda relacionada
	**/
	public function getNameSearch($dato){
            $this->db->select('city.id, city.name');
            $this->db->from('city');
            $this->db->like('city.name', $dato);
            $this->db->where('city.status = 1');
            return  $this->db->get()->result();
	}
    
          
}
