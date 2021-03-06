<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class api_db extends CI_MODEL
{
 
    public function __construct(){
        parent::__construct();
    }
    
    /**
     * Obtiene todos los registros activos del catalogo
     */
    public function getEventFav($idApp){
        $this->db->select("event.id, event.name as title, event.info, event.eventTypeId, event.place as subtitle1, city.name as subtitle2, event.image, event.date, event.fav");
        $this->db->select ("date_format(event.date, '%l:%i%p') as time", false);
        $this->db->select(" (select count(*) from xref_user_coupon_fav where userId = ".$idApp." and  typeId = 2 and couponId = event.id) as isFav, event.latitude, event.longitude ");
        $this->db->from('event');
        $this->db->join('city', 'event.idCity = city.id ');
        $this->db->where('event.status = 1');
        $this->db->where('event.fav = 1');
        $this->db->where('event.date >= curdate()');
        $this->db->order_by("event.date", "asc");
        return  $this->db->get()->result();
    }
    
    /**
     * Obtiene todos los registros activos del catalogo
     */
    public function getEvent($idApp, $isToFav, $nextDays){
        $this->db->select("event.id, event.name as title, event.info, event.eventTypeId, event.place as subtitle1, city.name as subtitle2, event.image, event.date, event.fav");
        $this->db->select ("date_format(event.date, '%l:%i%p') as time", false);
        $this->db->select(" (select count(*) from xref_user_coupon_fav where userId = ".$idApp." and  typeId = 2 and couponId = event.id) as isFav, event.latitude, event.longitude ");
        $this->db->from('event');
        $this->db->join('city', 'event.idCity = city.id ');
        if ($isToFav){ 
            $this->db->join('xref_user_coupon_fav', 'event.id = xref_user_coupon_fav.couponId and typeId = 2');
            $this->db->where('userId', $idApp);
        }
        if ($nextDays >= 0){ 
            $this->db->where('event.date = DATE_ADD(curdate(), INTERVAL '.$nextDays.' DAY)');
        }else{
            $this->db->where('event.date >= curdate()');
        }
        $this->db->where('event.status = 1');
        $this->db->order_by("event.date", "asc");
        return  $this->db->get()->result();
    }
    
    /**
     * Obtiene todos los registros activos del catalogo
     */
    public function getEventNoFav($idApp){
        $this->db->select("event.id, event.name as title, event.info, event.eventTypeId, event.place as subtitle1, city.name as subtitle2, event.image, event.date, event.fav");
        $this->db->select ("date_format(event.date, '%l:%i%p') as time", false);
        $this->db->select(" (select count(*) from xref_user_coupon_fav where userId = ".$idApp." and  typeId = 2 and couponId = event.id) as isFav, event.latitude, event.longitude ");
        $this->db->from('event');
        $this->db->join('city', 'event.idCity = city.id ');
        $this->db->where('event.status = 1');
        $this->db->where('event.fav = 0');
        $this->db->where('event.date >= curdate()');
        $this->db->order_by("event.date", "asc");
        return  $this->db->get()->result();
    }
 
    /**
     * Obtiene todos los registros activos del catalogo
     */
    public function getPlace($idApp, $isToFav){
        $this->db->select('place.id, place.name as title, city.name as subtitle1, place.image, place.txtMax, place.latitude, place.longitude');
        $this->db->select(" (select count(*) from xref_user_coupon_fav where userId = ".$idApp." and  typeId = 5 and couponId = place.id) as isFav ");
        $this->db->from('place');
        $this->db->join('city', 'place.cityId = city.id ');
        if ($isToFav){ 
            $this->db->join('xref_user_coupon_fav', 'place.id = xref_user_coupon_fav.couponId and typeId = 5');
            $this->db->where('userId', $idApp);
        }
        $this->db->where('place.status = 1');
        $this->db->order_by("place.id", "desc");
        return  $this->db->get()->result();
    }
 
    /**
     * Obtiene el registro del catalogo
     */
    public function getSporttv($idApp, $isToFav, $nextDays){
        $this->db->select ('sporttv.id, sporttv.name as title, sporttv.torneo as subtitle1, sporttv.image, date(sporttv.date) as date');
        $this->db->select ("date_format(sporttv.date, '%l:%i%p') as time", false);
        $this->db->select(" (select count(*) from xref_user_coupon_fav where userId = ".$idApp." and  typeId = 6 and couponId = sporttv.id) as isFav ");
        $this->db->from('sporttv');
        $this->db->join('sporttv_type', 'sporttv.sporttvTypeId = sporttv_type.id');
        if ($isToFav){ 
            $this->db->join('xref_user_coupon_fav', 'sporttv.id = xref_user_coupon_fav.couponId and typeId = 6');
            $this->db->where('xref_user_coupon_fav.userId', $idApp);
        }
        if ($nextDays >= 0){ 
            $this->db->where('date(sporttv.date) = DATE_ADD(curdate(), INTERVAL '.$nextDays.' DAY)');
        }else{
            $this->db->where('sporttv.date >= curdate()');
        }
        $this->db->where('sporttv.status = 1');
        $this->db->where('sporttv_type.status = 1');
        $this->db->order_by("sporttv.date");
        return  $this->db->get()->result();
    }
    
    /**
     * Obtiene todos los registros activos del catalogo
     */
    public function getCoupon($idApp, $isToFav, $nextDays, $type){
        $this->db->select ('coupon.id, coupon.image, coupon.detail, coupon.description as title');
        $this->db->select ('city.name as cityName, coupon.clauses, coupon.validity');
        $this->db->select ('partner.name as partnerName, partner.latitude, partner.longitude');
        $this->db->select(" (select count(*) from xref_user_coupon_fav where userId = ".$idApp." and  ( typeId = 3 or typeId = 4 ) and couponId = coupon.id) as isFav ");
        if ($nextDays >= 0){ $this->db->select("xref_coupon_day.day");}
        $this->db->from('coupon');
        $this->db->join('xref_coupon_catalog', 'xref_coupon_catalog.couponId = coupon.id');
        $this->db->join('catalog', 'catalog.id = xref_coupon_catalog.catalogId ');
        $this->db->join('partner', 'coupon.partnerId = partner.id ');
        $this->db->join('city', 'coupon.cityId = city.id ');
        if ($isToFav){ 
            $this->db->join('xref_user_coupon_fav', 'coupon.id = xref_user_coupon_fav.couponId and ( typeId = 3 or typeId = 4 )');
            $this->db->where('userId', $idApp);
        }
        if ($nextDays >= 0){ 
            $this->db->join('xref_coupon_day', 'xref_coupon_day.couponId = coupon.id and (day = DAYOFWEEK(DATE_ADD(curdate(), INTERVAL '.$nextDays.' DAY)))');
        }else if ($nextDays == -2){
            $this->db->join('xref_coupon_day', 'xref_coupon_day.couponId = coupon.id and day = 8');
            
        }
        $this->db->where('coupon.status = 1');
        $this->db->where('catalog.status = 1');
        if ($type > 0){
            $this->db->where('catalog.type', $type);
        }
        $this->db->where('coupon.iniDate <= curdate()');
        $this->db->where('coupon.endDate >= curdate()');
        if ($nextDays >= 0){ $this->db->order_by("xref_coupon_day.day"); }
        $this->db->group_by('coupon.id'); 
        return  $this->db->get()->result();
    }
    
    /**
     * Obtiene todos los registros activos del catalogo
     */
    public function getComercioCupon($idApp, $idComer){
    $this->db->select ('coupon.id, coupon.image, coupon.detail, coupon.description as title');
        $this->db->select ('coupon.id, coupon.image, coupon.detail, coupon.description as title');
        $this->db->select ('city.name as cityName, coupon.clauses, coupon.validity');
        $this->db->select ('partner.name as partnerName, partner.latitude, partner.longitude');
        $this->db->select(" (select count(*) from xref_user_coupon_fav where userId = ".$idApp." and  ( typeId = 3 or typeId = 4 ) and couponId = coupon.id) as isFav ");
        $this->db->from('coupon');
        $this->db->join('xref_coupon_catalog', 'xref_coupon_catalog.couponId = coupon.id');
        $this->db->join('catalog', 'catalog.id = xref_coupon_catalog.catalogId ');
        $this->db->join('partner', 'coupon.partnerId = partner.id ');
        $this->db->join('city', 'coupon.cityId = city.id ');
        $this->db->where('coupon.partnerId', $idComer);
        $this->db->where('coupon.status = 1');
        $this->db->where('catalog.status = 1');
        $this->db->where('coupon.iniDate <= curdate()');
        $this->db->where('coupon.endDate >= curdate()');
        $this->db->group_by('coupon.id'); 
        return  $this->db->get()->result();
    }
    
    /**
     * Obtiene todos los registros activos del catalogo
     */
    public function getCouponSubType($idApp, $subtype){
        $this->db->select ('coupon.id, coupon.image, coupon.detail, coupon.description as title');
        $this->db->select ('city.name as cityName, coupon.clauses, coupon.validity');
        $this->db->select ('partner.name as partnerName, partner.latitude, partner.longitude');
        $this->db->select(" (select count(*) from xref_user_coupon_fav where userId = ".$idApp." and  ( typeId = 3 or typeId = 4 ) and couponId = coupon.id) as isFav ");
        $this->db->from('coupon');
        $this->db->join('xref_coupon_catalog', 'xref_coupon_catalog.couponId = coupon.id');
        $this->db->join('catalog', 'catalog.id = xref_coupon_catalog.catalogId ');
        $this->db->join('partner', 'coupon.partnerId = partner.id ');
        $this->db->join('city', 'coupon.cityId = city.id ');
        $this->db->where('coupon.status = 1');
        $this->db->where('catalog.status = 1');
        $this->db->where('catalog.id', $subtype);
        $this->db->where('coupon.iniDate <= curdate()');
        $this->db->where('coupon.endDate >= curdate()');
        $this->db->group_by('coupon.id'); 
        return  $this->db->get()->result();
    }
    
    /**
     * Obtiene todos los registros activos del catalogo
     */
    public function getSubmenu($type){
        $this->db->select ('catalog.id, catalog.name');
        $this->db->from('coupon');
        $this->db->join('xref_coupon_catalog', 'xref_coupon_catalog.couponId = coupon.id');
        $this->db->join('catalog', 'catalog.id = xref_coupon_catalog.catalogId ');
        $this->db->where('coupon.status = 1');
        $this->db->where('catalog.status = 1');
        $this->db->where('catalog.type', $type);
        $this->db->where('coupon.iniDate <= curdate()');
        $this->db->where('coupon.endDate >= curdate()');
        $this->db->group_by('catalog.id'); 
        return  $this->db->get()->result();
    }
    
    /**
     * Obtiene todos los registros activos del catalogo
     */
    public function getServices(){
        $this->db->select ('map_service.name, map_category.id as categoryId, map_category.name as category, map_service.phone, map_service.latitude, map_service.longitude');
        $this->db->from('map_service');
        $this->db->join('map_category', 'map_service.idCatMap = map_category.id');
        $this->db->where('map_category.status = 1');
        return  $this->db->get()->result();
    }
    
    /**
     * Obtiene todos los registros activos del catalogo
     */
    public function getDirectoryType(){
        $this->db->select ('id, name');
        $this->db->from('directory_type');
        $this->db->where('status = 1');
        return  $this->db->get()->result();
    }
    
    /**
     * Obtiene todos los registros activos del catalogo
     */
    public function getCouponType($type){
        $this->db->select ('catalog.id, catalog.name');
        $this->db->from('coupon');
        $this->db->join('xref_coupon_catalog', 'xref_coupon_catalog.couponId = coupon.id');
        $this->db->join('catalog', 'catalog.id = xref_coupon_catalog.catalogId ');
        $this->db->where('coupon.status = 1');
        $this->db->where('catalog.status = 1');
        $this->db->where('catalog.type', $type);
        $this->db->where('coupon.iniDate <= curdate()');
        $this->db->where('coupon.endDate >= curdate()');
        $this->db->group_by('catalog.id'); 
        return  $this->db->get()->result();
    }
    
    /**
     * Obtiene todos los registros activos del catalogo
     */
    public function getDirectory(){
        $this->db->from('directory');
        $this->db->where('status = 1');
        $this->db->order_by("name");
        return  $this->db->get()->result();
    }
    
    /**
     * Obtiene todos los registros activos del catalogo
     */
    public function getDate($nextDays){
        $this->db->select ('DATE_ADD(curdate(), INTERVAL '.$nextDays.' DAY) as date', false);
        $this->db->from('directory_type');
        return  $this->db->get()->result()[0]->date;
    }
    
    /**
     * Obtiene todos los registros activos del catalogo
     */ 
	public function getComer(){
            //id,name,logo
		$this->db->select ('partner.id, partner.name, partner.logo as image, partner.idCatMap, partner.address, partner.phone');
        $this->db->select('map_category.name as categoryName, partner.banner, info');
		$this->db->from('partner');
		$this->db->join('map_category','partner.idCatMap = map_category.id');
		$this->db->where('partner.status = 1');
		$this->db->order_by("id", "asc");
        return  $this->db->get()->result();
	}
    
    /**
     * Obtiene todos los registros activos del catalogo
     */ 
	public function getComercio($id){
            //id,name,logo
		$this->db->select ('partner.id, partner.name, partner.logo as image, partner.idCatMap, partner.address, partner.phone');
        $this->db->select('map_category.name as categoryName, partner.banner, info');
		$this->db->from('partner');
		$this->db->join('map_category','partner.idCatMap = map_category.id');
		$this->db->where('partner.id', $id);
		$this->db->order_by("id", "asc");
        return  $this->db->get()->result();
	}
    
    /**
     * Obtiene todos los registros activos del catalogo
     */ 
	public function getAds(){
            //id,name,logo
		$this->db->select('id, message, uuid, latitude, longitude, distance, partnerId');
		$this->db->from('ads');
		$this->db->where('status = 1');
		$this->db->order_by("id", "asc");
        return  $this->db->get()->result();
	}
    
    
	 /**
	* insert un registro
	*/
	public function insertFav($data){
		$this->db->insert('xref_user_coupon_fav', $data);
	}
        
	/*
	*	Elimina el registro
	*/
    public function removeFav($data){
        $this->db->where($data);
        $this->db->delete('xref_user_coupon_fav');
    }


}
//end model