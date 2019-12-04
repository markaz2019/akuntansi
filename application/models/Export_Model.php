<?php defined('BASEPATH') or die('No direct script access allowed');

class Export_model extends CI_Model
{

    public function excel()
    {
        $this->db->select('*');
        $this->db->from('data');
        return $this->db->get();
    }

    public function pdf($tanggal)
    {
        $this->db->where('tanggal', $tanggal);
        $this->db->where('jenis', "masuk");
        $this->db->order_by('nomor ASC');
        $query = $this->db->get('data');
        return $query->result();
    }
    public function row($tanggal)
    {
        $this->db->where('tanggal', $tanggal);
        $this->db->where('jenis', "masuk");
        $this->db->order_by('nomor ASC');
        $query = $this->db->get('data');
        return $query->result();
    }
}
