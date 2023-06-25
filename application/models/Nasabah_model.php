<?php

class Nasabah_model extends CI_Model
{
    public function getNasabah()
    {
        return $this->db->get('tbl_nasabah')->result_array();
    }
    public function getNasabahByValue($key, $value)
    {
        return $this->db->get_where('tbl_nasabah', [$key => $value])->row_array();
    }
    public function addNasabah($data)
    {
        return $this->db->insert('tbl_nasabah', $data);
    }
    public function updateNasabah($key, $value, $data)
    {
        $this->db->where($key, $value);
        return $this->db->update('tbl_nasabah', $data);
    }
    public function deleteNasabah($id)
    {
        return $this->db->delete('tbl_nasabah', ['id_nasabah' => $id]);
    }

    public function getJumlahRow()
    {
        return $this->db->count_all_results('tbl_nasabah');
    }
}
