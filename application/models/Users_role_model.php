<?php

class Users_role_model extends CI_Model{
    public function getAllRole(){
        $this->db->order_by('nama_role', 'asc');
        return $this->db->get('tbl_users_role')->result_array();
    }
}