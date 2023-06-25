<?php

class Kategori_model extends CI_Model
{
    public function getKategori()
    {
        return $this->db->get('tbl_sampah_kategori')->result_array();
    }
    public function addKategori($data)
    {
        return $this->db->insert('tbl_sampah_kategori', $data);
    }
    public function cekKategori($key, $value)
    {
        return $this->db->get_where('tbl_sampah_kategori', [$key => $value])->row_array();
    }
    public function updateKatByClause($kolom, $key, $data)
    {
        $this->db->where($kolom, $key);
        return $this->db->update('tbl_sampah_kategori', $data);
    }
    public function updateKategori($id, $data)
    {
        $this->db->where('id_sampah_kat', $id);
        return $this->db->update('tbl_sampah_kategori', $data);
    }
    public function deleteKategori($id)
    {
        return $this->db->delete('tbl_sampah_kategori', ['id_sampah_kat' => $id]);
    }
}
