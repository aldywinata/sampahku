<?php

class Ulasan_model extends CI_Model
{
    public function getAllData()
    {
        $this->db->select('*');
        $this->db->from('tbl_review');
        $this->db->join('tbl_nasabah', 'tbl_nasabah.id_nasabah = tbl_review.id_nasabah');

        return $this->db->get()->result_array();
    }
    public function getUlasanByValue($key, $value)
    {
        return $this->db->get_where('tbl_review', [$key => $value])->row_array();
    }
    public function addUlasan($data)
    {
        return $this->db->insert('tbl_review', $data);
    }
    public function updateUlasanWhere($key, $value, $data)
    {
        $this->db->where($key, $value);
        return $this->db->update('tbl_review', $data);
    }
    public function deleteUlasan($id)
    {
        return $this->db->delete('tbl_review', ['id_review' => $id]);
    }

    public function getJumlahBy($key, $status)
    {
        $this->db->where($key, $status);
        return $this->db->count_all_results('tbl_review');
    }
}
