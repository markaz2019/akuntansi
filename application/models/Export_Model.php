<?php defined('BASEPATH') or die('No direct script access allowed');

class Export_model extends CI_Model
{

    public function excel()
    {
        $this->db->select('*');
        $this->db->from('data');
        return $this->db->get();
    }
    //PDF EXPORT KISEL
    public function pdf($tanggal)
    {
        $this->db->select('*');
        $this->db->from('data');
        $this->db->where('tanggal', $tanggal);
        $this->db->where('jenis', 'masuk');
        $query = $this->db->get();
        return $query->result();
    }

    public function pdf_mlink()
    {
        $this->db->select('*');
        $this->db->from('mlink');
        $this->db->where('jenis', 'masuk');
        return $this->db->get();
    }

    public function pdf_kisel_stokawal()
    {
        $this->db->select('*');
        $this->db->from('kisel_stokawal');
        $this->db->where('id', '1');
        return $this->db->get();
    }
    public function pdf_kisel_deposit()
    {
        $this->db->select('*');
        $this->db->from('kisel_deposit');
        $this->db->where('id', '1');
        return $this->db->get();
    }
    public function pdf_kisel_pemakaian()
    {
        $this->db->select('*');
        $this->db->from('kisel_pemakaian');
        $this->db->where('id', '1');
        return $this->db->get();
    }

    public function pdf_kisel_stockakhir()
    {
        $this->db->select('*');
        $this->db->from('kisel_stockakhir');
        $this->db->where('id', '1');
        return $this->db->get();
    }
    function ambil_data($nomor)
    {
        $this->db->where('nomor', $nomor);
        $query = $this->db->get('data');
        return $query->result_array();
    }
    function row_harian($tanggal)
    {
        $this->db->where('tanggal', $tanggal);
        $query = $this->db->get('data');
        return $query->num_rows();
    }
    function laporan_harian($tanggal, $number, $offset)
    {
        $this->db->where('tanggal', $tanggal);
        $this->db->order_by('nomor ASC');
        $query = $this->db->get('data', $number, $offset);
        return $query->result();
    }
}
