<?php

class Sampah_model extends CI_Model
{
    public function getAllData()
    {
        $this->db->select('*');
        $this->db->from('tbl_sampah');
        $this->db->join('tbl_sampah_kategori', 'tbl_sampah_kategori.id_sampah_kat = tbl_sampah.id_sampah_kat');
        $this->db->order_by('kode_sampah_kat', 'asc');

        return $this->db->get()->result_array();
    }
    public function getSampah($kolom, $id)
    {
        $this->db->select('*');
        $this->db->from('tbl_sampah');
        $this->db->join('tbl_sampah_kategori', 'tbl_sampah_kategori.id_sampah_kat = tbl_sampah.id_sampah_kat');
        $this->db->where($kolom, $id);

        return $this->db->get()->row_array();
    }
    public function cekSampah($key, $value)
    {
        return $this->db->get_where('tbl_sampah', [$key => $value])->row_array();
    }
    public function addSampah($data)
    {
        return $this->db->insert('tbl_sampah', $data);
    }
    public function updateSampah($id, $data)
    {
        $this->db->where('id_sampah', $id);
        return $this->db->update('tbl_sampah', $data);
    }
    public function deleteSampah($id)
    {
        return $this->db->delete('tbl_sampah', ['id_sampah' => $id]);
    }

    public function getJumlahRow()
    {
        return $this->db->count_all_results('tbl_sampah');
    }
}
