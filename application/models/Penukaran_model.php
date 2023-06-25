<?php

class Penukaran_model extends CI_Model
{
    public function getAllData()
    {
        $this->db->select('*');
        $this->db->from('tbl_penukaran');
        $this->db->join('tbl_nasabah', 'tbl_nasabah.id_nasabah = tbl_penukaran.id_nasabah');

        return $this->db->get()->result_array();
    }
    public function getPenukaranByOrderWhere($idn, $val)
    {
        $this->db->select('*');
        $this->db->from('tbl_penukaran');
        $this->db->join('tbl_nasabah', 'tbl_nasabah.id_nasabah = tbl_penukaran.id_nasabah');
        $this->db->where('tbl_penukaran.id_nasabah', $idn);
        $this->db->order_by('date_penukaran', $val);

        return $this->db->get()->result_array();
    }
    public function getPenukaranByValue($key, $value)
    {
        $this->db->select('*');
        $this->db->from('tbl_penukaran');
        $this->db->join('tbl_nasabah', 'tbl_nasabah.id_nasabah = tbl_penukaran.id_nasabah');
        $this->db->where($key, $value);

        return $this->db->get();
    }
    public function getPenukaranByOrder($val)
    {
        $this->db->select('*');
        $this->db->from('tbl_penukaran');
        $this->db->join('tbl_nasabah', 'tbl_nasabah.id_nasabah = tbl_penukaran.id_nasabah');
        $this->db->order_by('date_penukaran', $val);

        return $this->db->get()->result_array();
    }
    public function getPenukaransByDateRange($idn, $val, $startdate, $enddate)
    {
        // Konversi tanggal ke format UNIX timestamp
        $startdateTime = strtotime($startdate . ' 00:00:00');
        $enddateTime = strtotime($enddate . ' 23:59:59');

        // Query data berdasarkan rentang tanggal
        $this->db->select('*');
        $this->db->from('tbl_penukaran');
        $this->db->join('tbl_nasabah', 'tbl_nasabah.id_nasabah = tbl_penukaran.id_nasabah');
        $this->db->where('tbl_nasabah.id_nasabah', $idn);
        $this->db->where('tbl_penukaran.date_penukaran >=', $startdateTime);
        $this->db->where('tbl_penukaran.date_penukaran <=', $enddateTime);
        $this->db->order_by('tbl_penukaran.date_penukaran', $val);

        return $this->db->get()->result_array();
    }
    public function getPenukaranByDateRangeNoWhere($val, $startdate, $enddate)
    {
        // Konversi tanggal ke format UNIX timestamp
        $startdateTime = strtotime($startdate . ' 00:00:00');
        $enddateTime = strtotime($enddate . ' 23:59:59');

        // Query data berdasarkan rentang tanggal
        $this->db->select('*');
        $this->db->from('tbl_penukaran');
        $this->db->join('tbl_nasabah', 'tbl_nasabah.id_nasabah = tbl_penukaran.id_nasabah');
        $this->db->where('tbl_penukaran.date_penukaran >=', $startdateTime);
        $this->db->where('tbl_penukaran.date_penukaran <=', $enddateTime);
        $this->db->order_by('tbl_penukaran.date_penukaran', $val);

        return $this->db->get()->result_array();
    }
    public function getPenukaranNoJoinByVal($key, $value)
    {
        $this->db->where($key, $value);
        $this->db->limit(5);
        $this->db->order_by('date_penukaran', 'DESC');

        return $this->db->get('tbl_penukaran');
    }
    public function getJumlahBy($key, $status)
    {
        $this->db->where($key, $status);
        return $this->db->count_all_results('tbl_penukaran');
    }
    public function addPenukaran($data)
    {
        return $this->db->insert('tbl_penukaran', $data);
    }
    public function updatePenukaran($id, $data)
    {
        $this->db->where('id_penukaran', $id);
        return $this->db->update('tbl_penukaran', $data);
    }
    public function deletePenukaran($id)
    {
        return $this->db->delete('tbl_penukaran', ['id_penukaran' => $id]);
    }
}
