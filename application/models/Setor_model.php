<?php

class Setor_model extends CI_Model
{
    public function getAllData()
    {
        $this->db->select('*');
        $this->db->from('tbl_setor');
        $this->db->join('tbl_nasabah', 'tbl_nasabah.id_nasabah = tbl_setor.id_nasabah');
        $this->db->order_by('date_setor', 'DESC');

        return $this->db->get()->result_array();
    }
    public function getAllDataByOrder($order)
    {
        $this->db->select('*');
        $this->db->from('tbl_setor');
        $this->db->join('tbl_nasabah', 'tbl_nasabah.id_nasabah = tbl_setor.id_nasabah');
        $this->db->order_by('date_setor', $order);

        return $this->db->get()->result_array();
    }
    public function getAllDataByOrderWhere($idn, $val)
    {
        $this->db->select('*');
        $this->db->from('tbl_setor');
        $this->db->join('tbl_nasabah', 'tbl_nasabah.id_nasabah = tbl_setor.id_nasabah');
        $this->db->where('tbl_setor.id_nasabah', $idn);
        $this->db->order_by('date_setor', $val);

        return $this->db->get()->result_array();
    }
    public function getSetorByValue($key, $value)
    {
        $this->db->select('*');
        $this->db->from('tbl_setor');
        $this->db->join('tbl_nasabah', 'tbl_nasabah.id_nasabah = tbl_setor.id_nasabah');
        $this->db->where($key, $value);

        return $this->db->get();
    }
    public function getSetorNoJoinByVal($key, $value)
    {
        $this->db->where($key, $value);
        $this->db->limit(5);
        $this->db->order_by('date_setor', 'DESC');

        return $this->db->get('tbl_setor');
    }
    public function getJumlahBeratSetor($idn)
    {
        $this->db->select_sum('berat_setor');
        $this->db->from('tbl_setor');
        $this->db->where('id_nasabah', $idn);

        $result = $this->db->get()->row();

        return $result->berat_setor;
    }
    public function getJumlahBeratSetorNoWhere()
    {
        $this->db->select_sum('berat_setor');
        $this->db->from('tbl_setor');

        $result = $this->db->get()->row();

        return $result->berat_setor;
    }
    public function getSetorsByDateRange($idn, $val, $startdate, $enddate)
    {
        // Konversi tanggal ke format UNIX timestamp
        $startdateTime = strtotime($startdate . ' 00:00:00');
        $enddateTime = strtotime($enddate . ' 23:59:59');

        // Query data berdasarkan rentang tanggal
        $this->db->select('*');
        $this->db->from('tbl_setor');
        $this->db->join('tbl_nasabah', 'tbl_nasabah.id_nasabah = tbl_setor.id_nasabah');
        $this->db->where('tbl_nasabah.id_nasabah', $idn);
        $this->db->where('tbl_setor.date_setor >=', $startdateTime);
        $this->db->where('tbl_setor.date_setor <=', $enddateTime);
        $this->db->order_by('tbl_setor.date_setor', $val);

        return $this->db->get()->result_array();
    }

    public function getSetorsByDateRangeNoWhere($val, $startdate, $enddate)
    {
        // Konversi tanggal ke format UNIX timestamp
        $startdateTime = strtotime($startdate . ' 00:00:00');
        $enddateTime = strtotime($enddate . ' 23:59:59');

        // Query data berdasarkan rentang tanggal
        $this->db->select('*');
        $this->db->from('tbl_setor');
        $this->db->join('tbl_nasabah', 'tbl_nasabah.id_nasabah = tbl_setor.id_nasabah');
        $this->db->where('tbl_setor.date_setor >=', $startdateTime);
        $this->db->where('tbl_setor.date_setor <=', $enddateTime);
        $this->db->order_by('tbl_setor.date_setor', $val);

        return $this->db->get()->result_array();
    }


    public function updateSetor($key, $value, $data)
    {
        $this->db->where($key, $value);
        return $this->db->update('tbl_setor', $data);
    }
    public function addSetor($data)
    {
        return $this->db->insert('tbl_setor', $data);
    }
    public function deleteSetor($id)
    {
        return $this->db->delete('tbl_setor', ['id_setor' => $id]);
    }
}
