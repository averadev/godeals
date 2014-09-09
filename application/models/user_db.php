<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class user_db extends CI_MODEL
{
 
    public function __construct(){
        parent::__construct();
    }
 
    /**
     * Obtiene todos los registros activos del catalogo
     */
    public function insert($data){
        $this->db->insert('user', $data);
    }
    
    /**
     * Obtiene todos los registros activos del catalogo
     */
    public function update($data){
        $this->db->where('email', $data['email']);
        $this->db->update('user', $data);
    }
 
    /**
     * Obtiene todos los registros activos del catalogo
     */
    public function get($data){
        $this->db->from('user');
        $this->db->where($data);
        return $this->db->get()->result();
    }
 
    /**
     * Obtiene todos los registros activos del catalogo
     */
    public function verifyEmail($email){
        $this->db->from('user');
        $this->db->where('email', $email);
        return $this->db->get()->result();
    }
    
    /**
     * Obtiene todos los registros activos del catalogo
     */
    public function verifyEmailPass($email, $pass){
        $this->db->from('user');
        $this->db->where('email', $email);
        $this->db->where('password', $pass);
        return $this->db->get()->result();
    }

}
//end model