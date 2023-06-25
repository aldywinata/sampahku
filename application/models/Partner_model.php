<?php

class Partner_model extends CI_Model
{
    public function getAllData()
    {
        return $this->db->get('tbl_partner')->result_array();
    }
    public function getPartnerValue($key, $value)
    {
        return $this->db->get_where('tbl_partner', [$key => $value])->row_array();
    }
    public function addPartner($data)
    {
        return $this->db->insert('tbl_partner', $data);
    }
    public function updatePartner($key, $value, $data)
    {
        $this->db->where($key, $value);
        return $this->db->update('tbl_partner', $data);
    }
    public function deletePartner($id)
    {
        return $this->db->delete('tbl_partner', ['id_partner' => $id]);
    }
}
