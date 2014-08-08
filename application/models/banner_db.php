<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class banner_db extends CI_MODEL
{
 
    public function __construct(){
        parent::__construct();
    }
 
    /**
     * Obtiene todos los registros activos del catalogo
     */
    public function getAvailable(){
        $this->db->select('banner.id, banner.image, banner.partnerId, partner.logo');
        $this->db->from('banner');
        $this->db->join('partner', 'banner.partnerId = partner.id ');
        $this->db->where('banner.status = 1');
        $this->db->where('partner.status = 1');
        $this->db->where('banner.iniDate <= curdate()');
        $this->db->where('banner.endDate >= curdate()');
        return  $this->db->get()->result();
    }


}
//end model