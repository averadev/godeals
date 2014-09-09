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
        $this->db->select ('coupon.id, coupon.image, coupon.description, coupon.clauses, coupon.validity, coupon.partnerId');
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
        $this->db->select ('coupon.timer, coupon.image, coupon.description, coupon.detail, coupon.iniDate, coupon.endDate');
        $this->db->select ('coupon.partnerId, coupon.cityId, partner.name as partnerName, city.name as cityName');
        $this->db->from('coupon');
        $this->db->join('partner', 'coupon.partnerId = partner.id ');
        $this->db->join('city', 'coupon.cityId = city.id ');
        $this->db->where('coupon.id = ', $id);
        $this->db->where('coupon.status = 1');
        return  $this->db->get()->result();
    }
	
	public function updateCoupon($id,$partnerId,$cityId,$timer,$image,$description,$detail,$iniDate,$endDate,$idCatalog){
        $data = array(
				'partnerId' => $partnerId,
			   'cityId' => $cityId,
			   'timer' => $timer,
			   'image' => $image,
               'description' => $description,
               'detail' => $detail,
               'iniDate' => $iniDate,
			   'endDate' => $endDate
            );
		$this->db->where('id', $id);
		$this->db->update('coupon', $data);
		$this->db->delete('xref_coupon_catalog', array('couponId' => $id));
		$data2;
		foreach($idCatalog as $idC){
			$data2 = array(
				'couponId' => $id,
				'catalogId'=> $idC
			);
			$this->db->insert('xref_coupon_catalog', $data2);	
		}
    }
	
	public function deleteCoupon($id){
        $data = array(
				'status' => 0
            );
		$this->db->where('id', $id);
		$this->db->update('coupon', $data);
    }

	public function insertCoupon($partnerId,$cityId,$timer,$image,$description,$detail,$iniDate,$endDate,$idCatalog){
		$data = array(
   			'partnerId' => $partnerId,
   			'cityId' => $cityId ,
   			'timer' => $timer,
			'image' => $image,
			'description' => $description,
			'detail' => $detail,
			'iniDate' => $iniDate,
			'endDate' => $endDate,
			'status' => 1
		);
		$this->db->insert('coupon', $data);	
		$id = $this->db->insert_id();
		$data2;
		foreach($idCatalog as $idC){
			$data2 = array(
				'couponId' => $id,
				'catalogId'=> $idC
			);
			$this->db->insert('xref_coupon_catalog', $data2);	
		}
	}

}
//end model