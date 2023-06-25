<?php

class Hadiah_model extends CI_Model
{
    public function getHadiah()
    {
        return $this->db->get('tbl_reward')->result_array();
    }
    public function addHadiah($data)
    {
        return $this->db->insert('tbl_reward', $data);
    }
    public function getHadiahFilter($jenis)
    {
        if ($jenis == 'poin_kecil') {
            $this->db->order_by('poin_reward', 'ASC');
        } elseif ($jenis == 'poin_besar') {
            $this->db->order_by('poin_reward', 'DESC');
        } elseif ($jenis == 'tukar_barang') {
            $this->db->where('jenis_reward', 'tukar_barang');
        } elseif ($jenis == 'midtrans') {
            $this->db->where('jenis_reward', 'midtrans');
        }

        return $this->db->get('tbl_reward')->result_array();
    }
    public function getHadiahByValue($key, $value)
    {
        return $this->db->get_where('tbl_reward', [$key => $value])->row_array();
    }
    public function updateHadiah($id, $data)
    {
        $this->db->where('kode_reward', $id);
        return $this->db->update('tbl_reward', $data);
    }
    public function deleteReward($kd)
    {
        return $this->db->delete('tbl_reward', ['kode_reward' => $kd]);
    }
}
