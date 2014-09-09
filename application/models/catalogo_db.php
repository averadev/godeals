<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class catalogo_db extends CI_MODEL
{
 
    public function __construct(){
        parent::__construct();
    }
 
    /**
     * Obtiene todos los registros activos del catalogo
     */
    public function getAllCity(){
        $this->db->from('city');
        $this->db->where('status = 1');
        return  $this->db->get()->result();
    }
    
    /**
     * Obtiene todos los registros activos del catalogo
     */
    public function getAllCatalog($type){
        $this->db->select('catalog.id, catalog.name, count(*) as number');
        $this->db->from('catalog');
        $this->db->join('xref_coupon_catalog', 'catalog.id = xref_coupon_catalog.catalogId');
        $this->db->join('coupon', 'xref_coupon_catalog.couponId = coupon.id ');
        $this->db->where('coupon.status = 1');
        $this->db->where('catalog.status = 1');
        $this->db->where('catalog.type', $type);
        $this->db->where('coupon.iniDate <= curdate()');
        $this->db->where('coupon.endDate >= curdate()');
        $this->db->group_by('catalog.id'); 
        $this->db->order_by("catalog.id");
        return  $this->db->get()->result();
    }
    
    public function getCatalogOfCoupon($couponId){
		
		$this->db->select('xref_coupon_catalog.catalogId');
        $this->db->from('xref_coupon_catalog');
		$this->db->where('xref_coupon_catalog.couponId',$couponId);
        return  $this->db->get()->result();
			
	}
	
	public function getCatalog($type){
		$this->db->select('catalog.id, catalog.name');
		$this->db->from('catalog');
		$this->db->where('catalog.type',$type);
		$this->db->where('catalog.status = 1');
		return $this->db->get()->result();
	}
}
//end model