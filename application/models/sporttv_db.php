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


}
//end model