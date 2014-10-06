<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class api_db extends CI_MODEL
{
 
    public function __construct(){
        parent::__construct();
    }
    
    /**
     * Obtiene todos los registros activos del catalogo
     */
    public function getEventFav(){
        $this->db->select("event.id, event.name as title, event.info, event.eventTypeId, event.place as subtitle1, city.name as subtitle2, event.image, event.date, event.fav");
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
    public function getEvent(){
        $this->db->select("event.id, event.name as title, event.info, event.eventTypeId, event.place as subtitle1, city.name as subtitle2, event.image, event.date, event.fav");
        $this->db->from('event');
        $this->db->join('city', 'event.idCity = city.id ');
        $this->db->where('event.status = 1');
        $this->db->where('event.date >= curdate()');
        $this->db->order_by("event.date", "asc");
        return  $this->db->get()->result();
    }
    
    /**
     * Obtiene todos los registros activos del catalogo
     */
    public function getEventNoFav(){
        $this->db->select("event.id, event.name as title, event.info, event.eventTypeId, event.place as subtitle1, city.name as subtitle2, event.image, event.date, event.fav");
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
    public function getPlace(){
        $this->db->select('place.id, place.name as title, city.name as subtitle1, place.image, place.txtMax');
        $this->db->from('place');
        $this->db->join('city', 'place.cityId = city.id ');;
        $this->db->where('place.status = 1');
        $this->db->order_by("place.id", "desc");
        return  $this->db->get()->result();
    }
 
    /**
     * Obtiene el registro del catalogo
     */
    public function getSporttv(){
        $this->db->select ('sporttv.id, sporttv.name as title, sporttv.torneo as subtitle1, sporttv.image, date(sporttv.date) as date');
        $this->db->select ("date_format(sporttv.date, '%l:%i%p') as time", false);
        $this->db->from('sporttv');
        $this->db->join('sporttv_type', 'sporttv.sporttvTypeId = sporttv_type.id');
        $this->db->where('sporttv.status = 1');
        $this->db->where('sporttv_type.status = 1');
        $this->db->order_by("sporttv.date");
        return  $this->db->get()->result();
    }
    
    /**
     * Obtiene todos los registros activos del catalogo
     */
    public function getCoupon($type){
        $this->db->select ('coupon.id, coupon.image, coupon.detail, coupon.description as title');
        $this->db->select ('city.name as cityName, coupon.clauses, coupon.validity');
        $this->db->select ('partner.name as partnerName, partner.latitude, partner.longitude');
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
    public function getCouponSubType($subtype){
        $this->db->select ('coupon.id, coupon.image, coupon.detail, coupon.description as title');
        $this->db->select ('city.name as cityName, coupon.clauses, coupon.validity');
        $this->db->select ('partner.name as partnerName, partner.latitude, partner.longitude');
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


}
//end model