<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class partner_db extends CI_MODEL
{
 
    public function __construct(){
        parent::__construct();
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
    
          
}

