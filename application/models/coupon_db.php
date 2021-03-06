<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class coupon_db extends CI_MODEL
{
 
    public function __construct(){
        parent::__construct();
    }
 
    /**
     * Obtiene el registro del catalogo
     */
    public function get($id){
        $this->db->select ('coupon.id, coupon.image, coupon.description, coupon.detail, coupon.clauses, coupon.validity, coupon.partnerId');
        $this->db->select ('coupon.cityId, partner.name as partnerName, city.name as cityName, partner.logo');
        $this->db->from('coupon');
        $this->db->join('partner', 'coupon.partnerId = partner.id ');
        $this->db->join('city', 'coupon.cityId = city.id ');
        $this->db->where('coupon.id = ', $id);
        $this->db->where('coupon.status = 1');
        return  $this->db->get()->result();
    }
 
    /**
     * Obtiene todos los registros activos del catalogo
     */
    public function getAvailable(){
        $this->db->from('coupon');
        $this->db->where('status = 1');
        $this->db->where('iniDate <= curdate()');
        $this->db->where('endDate >= curdate()');
        return  $this->db->get()->result();
    }
    
    /**
     * Obtiene todos los registros activos del catalogo
     */
    public function getHomeCoupons(){
        $this->db->select ('coupon.id, coupon.image, coupon.description, coupon.partnerId, coupon.cityId');
        $this->db->select ('partner.name as partnerName, city.name as cityName');
        $this->db->from('coupon');
        $this->db->join('partner', 'coupon.partnerId = partner.id ');
        $this->db->join('city', 'coupon.cityId = city.id ');
        $this->db->where('coupon.status = 1');
        $this->db->where('coupon.timer = 0');
        $this->db->where('coupon.iniDate <= curdate()');
        $this->db->where('coupon.endDate >= curdate()');
        return  $this->db->get()->result();
    }
    
    /**
     * Obtiene todos los registros activos del catalogo
     */
    public function getHomeTimers(){
        $this->db->select ('coupon.id, coupon.image, coupon.description, coupon.partnerId, coupon.cityId');
        $this->db->select ('partner.name as partnerName, city.name as cityName');
        $this->db->from('coupon');
        $this->db->join('partner', 'coupon.partnerId = partner.id ');
        $this->db->join('city', 'coupon.cityId = city.id ');
        $this->db->where('coupon.status = 1');
        $this->db->where('coupon.timer = 1');
        $this->db->where('coupon.iniDate <= curdate()');
        $this->db->where('coupon.endDate >= curdate()');
        return  $this->db->get()->result();
    }
    
    /**
     * Obtiene todos los registros activos del catalogo
     */
    public function getByType($type){
        $this->db->select ('coupon.id, coupon.image, coupon.description, coupon.partnerId, coupon.cityId');
        $this->db->select ('partner.name as partnerName, city.name as cityName');
        $this->db->from('coupon');
        $this->db->join('xref_coupon_catalog', 'xref_coupon_catalog.couponId = coupon.id');
        $this->db->join('catalog', 'catalog.id = xref_coupon_catalog.catalogId ');
        $this->db->join('partner', 'coupon.partnerId = partner.id ');
        $this->db->join('city', 'coupon.cityId = city.id ');
        $this->db->where('coupon.status = 1');
        $this->db->where('catalog.status = 1');
        $this->db->where('catalog.type', $type);
        $this->db->where('coupon.iniDate <= curdate()');
        $this->db->where('coupon.endDate >= curdate()');
        $this->db->group_by('coupon.id'); 
        return  $this->db->get()->result();
    }
    
    /**
     * Obtiene todos los registros activos del catalogo
     */
    public function getByPartner($id){
        $this->db->select ('coupon.id, coupon.image, coupon.description, coupon.partnerId, coupon.cityId');
        $this->db->select ('partner.name as partnerName, city.name as cityName');
        $this->db->from('coupon');
        $this->db->join('xref_coupon_catalog', 'xref_coupon_catalog.couponId = coupon.id');
        $this->db->join('catalog', 'catalog.id = xref_coupon_catalog.catalogId ');
        $this->db->join('partner', 'coupon.partnerId = partner.id ');
        $this->db->join('city', 'coupon.cityId = city.id ');
        $this->db->where('coupon.status = 1');
        $this->db->where('coupon.partnerId', $id);
        $this->db->where('coupon.iniDate <= curdate()');
        $this->db->where('coupon.endDate >= curdate()');
        $this->db->group_by('coupon.id'); 
        return  $this->db->get()->result();
    }
    
    /**
     * Obtiene todos los registros activos del catalogo
     */
    public function getByPlace($id){
        $this->db->select ('coupon.id, coupon.image, coupon.description, coupon.partnerId, coupon.cityId');
        $this->db->select ('partner.name as partnerName, city.name as cityName');
        $this->db->from('coupon');
        $this->db->join('xref_coupon_catalog', 'xref_coupon_catalog.couponId = coupon.id');
        $this->db->join('catalog', 'catalog.id = xref_coupon_catalog.catalogId ');
        $this->db->join('partner', 'coupon.partnerId = partner.id ');
        $this->db->join('city', 'coupon.cityId = city.id ');
        $this->db->where('coupon.status = 1');
        $this->db->where('city.id', $id);
        $this->db->where('coupon.iniDate <= curdate()');
        $this->db->where('coupon.endDate >= curdate()');
        $this->db->group_by('coupon.id'); 
        return  $this->db->get()->result();
    }
    
    /**
     * Obtiene todos los registros activos del catalogo
     */
    public function getByTxt($text){
        $this->db->select ('coupon.id, coupon.image, coupon.description, coupon.partnerId, coupon.cityId');
        $this->db->select ('partner.name as partnerName, city.name as cityName');
        $this->db->from('coupon');
        $this->db->join('xref_coupon_catalog', 'xref_coupon_catalog.couponId = coupon.id');
        $this->db->join('catalog', 'catalog.id = xref_coupon_catalog.catalogId ');
        $this->db->join('partner', 'coupon.partnerId = partner.id ');
        $this->db->join('city', 'coupon.cityId = city.id ');
        $this->db->where('coupon.status = 1');
        $this->db->where('(city.name LIKE \'%'.$text.'%\' OR coupon.description LIKE \'%'.$text.'%\' OR coupon.detail LIKE \'%'.$text.'%\' OR partner.name LIKE \'%'.$text.'%\' OR catalog.name LIKE \'%'.$text.'%\')', NULL); 
        $this->db->where('coupon.iniDate <= curdate()');
        $this->db->where('coupon.endDate >= curdate()');
        $this->db->group_by('coupon.id'); 
        return  $this->db->get()->result();
    }
    
    /**
     * Obtiene todos los registros activos del catalogo
     */
    public function getByTypeCat($type, $categorie){
        $this->db->select ('coupon.id, coupon.image, coupon.description, coupon.partnerId, coupon.cityId');
        $this->db->select ('partner.name as partnerName, city.name as cityName');
        $this->db->from('coupon');
        $this->db->join('xref_coupon_catalog', 'xref_coupon_catalog.couponId = coupon.id');
        $this->db->join('catalog', 'catalog.id = xref_coupon_catalog.catalogId ');
        $this->db->join('partner', 'coupon.partnerId = partner.id ');
        $this->db->join('city', 'coupon.cityId = city.id ');
        $this->db->where('coupon.status = 1');
        $this->db->where('catalog.status = 1');
        $this->db->where('catalog.type', $type);
        $this->db->where('catalog.id', $categorie);
        $this->db->where('coupon.iniDate <= curdate()');
        $this->db->where('coupon.endDate >= curdate()');
        $this->db->group_by('coupon.id'); 
        return  $this->db->get()->result();
    }

	public function getAllActive(){
        
        //id,descripcion,cliente,ciudad,fechainicio,fechafin
        
        $this->db->select ('coupon.id, coupon.description, coupon.cityId, coupon.partnerId, coupon.iniDate, coupon.endDate');
        $this->db->select ('partner.name as partnerName, city.name as cityName');
        $this->db->from('coupon');
        $this->db->join('partner', 'coupon.partnerId = partner.id ');
        $this->db->join('city', 'coupon.cityId = city.id ');
        $this->db->where('coupon.status = 1');
		$this->db->order_by("id", "asc");
        return  $this->db->get()->result();
    }
	
	/**
	* obtiene la descripcion, clientes y ubicacion de la busqueda relacionada
	**/
	
	public function getallSearch($dato,$column,$order){
		$this->db->select ('coupon.id, coupon.description, coupon.cityId, coupon.partnerId, coupon.iniDate, coupon.endDate');
		 $this->db->select ('partner.name as partnerName, city.name as cityName');
        $this->db->from('coupon');
		$this->db->join('partner', 'coupon.partnerId = partner.id ');
        $this->db->join('city', 'coupon.cityId = city.id ');
		$this->db->where('coupon.status = 1');
		/*$this->db->like('coupon.description', $dato);
		$this->db->or_like('partner.name', $dato);
		$this->db->or_like('city.name', $dato);*/
		$this->db->where('(coupon.description LIKE \'%'.$dato.'%\' OR partner.name LIKE \'%'.$dato.'%\' 
		OR city.name LIKE \'%' . $dato . '%\')', NULL); 
		$this->db->order_by($column , $order);
        return  $this->db->get()->result();
	}
	
	public function getId($id){
        $this->db->select ('coupon.timer, coupon.image, coupon.description, coupon.validity, coupon.clauses,
		 coupon.detail, coupon.iniDate, coupon.endDate');
        $this->db->select ('coupon.partnerId, coupon.cityId, partner.name as partnerName, city.name as cityName');
        $this->db->from('coupon');
        $this->db->join('partner', 'coupon.partnerId = partner.id ');
        $this->db->join('city', 'coupon.cityId = city.id ');
        $this->db->where('coupon.id = ', $id);
        $this->db->where('coupon.status = 1');
        return  $this->db->get()->result();
    }
	
	public function getDaysOfCoupon($couponId){
		$this->db->select('day');
		$this->db->from('xref_coupon_day');
		$this->db->where('couponId',$couponId);
		return $this->db->get()->result();
	}
	
	public function updateCoupon($data,$delete,$Catalog,$deleteDay,$daySelec){
		$this->db->where('id', $data['id']);
		$this->db->update('coupon', $data);
		$this->db->delete('xref_coupon_catalog',$delete);
		$this->db->insert_batch('xref_coupon_catalog', $Catalog);
		$this->db->delete('xref_coupon_day',$deleteDay);
		$this->db->insert_batch('xref_coupon_day', $daySelec);
    }
	
	public function deleteCoupon($data){
		$this->db->where('id', $data['id']);
		$this->db->update('coupon', $data);
    }

	public function insertCoupon($data,$idCatalog,$days){
		
		$this->db->insert('coupon', $data);	
		$id = $this->db->insert_id();
		
		$catalog = array();
		foreach($idCatalog as $idC){
			array_push($catalog, array(
				'couponId' => $id,
				'catalogId'=> $idC));	
		}
		$this->db->insert_batch('xref_coupon_catalog', $catalog);
		
		$daySelec = array();
		foreach($days as $day){
			array_push($daySelec, array(
				'couponId' => $id,
				'day'=> $day));	
		}
		$this->db->insert_batch('xref_coupon_day', $daySelec);
	}

}
//end model