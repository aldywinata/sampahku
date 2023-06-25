<?php

class Users_model extends CI_Model
{
    public function getUserByUsername($username)
    {
        $this->db->select('*');
        $this->db->from('tbl_users');
        $this->db->join('tbl_users_role', 'tbl_users_role.id_users_role = tbl_users.id_users_role');
        $this->db->where('username', $username);

        return $this->db->get()->row_array();
    }

    public function getUserById($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_users');
        $this->db->join('tbl_users_role', 'tbl_users_role.id_users_role = tbl_users.id_users_role');
        $this->db->where('id_users', $id);

        return $this->db->get()->row_array();
    }

    public function getAllData()
    {
        $this->db->select('*');
        $this->db->from('tbl_users');
        $this->db->join('tbl_users_role', 'tbl_users_role.id_users_role = tbl_users.id_users_role');
        $this->db->order_by('nama_role', 'asc');

        return $this->db->get()->result_array();
    }

    public function addUser($data)
    {
        return $this->db->insert('tbl_users', $data);
    }

    public function cekUser($key, $value)
    {
        return $this->db->get_where('tbl_users', [$key => $value])->row_array();
    }

    public function updateUser($kolom, $val, $data)
    {
        $this->db->where($kolom, $val);
        return $this->db->update('tbl_users', $data);
    }
    public function deleteUser($id)
    {
        return $this->db->delete('tbl_users', ['id_users' => $id]);
    }
}
