<?php

class Config_model extends CI_Model
{
    public function getData()
    {
        return $this->db->get_where('tbl_system_info', ['id_sysfo' => '1'])->row_array();
    }
    public function getSysfoByValue($id)
    {
        return $this->db->get_where('tbl_system_info', ['id_sysfo' => $id])->row_array();
    }
    public function updateConfig($id, $data)
    {
        $this->db->where('id_sysfo', $id);
        return $this->db->update('tbl_system_info', $data);
    }
}
